DROP TABLE TaskDependencies CASCADE;
DROP TABLE Comment CASCADE;
DROP TABLE Task CASCADE;
DROP TABLE "group" CASCADE;
DROP TABLE Preferences CASCADE;
DROP TABLE Account CASCADE;

CREATE TABLE "account" (
    "id" SERIAL PRIMARY KEY,
    "name" VARCHAR(255) NOT NULL,
    "email" VARCHAR(255) UNIQUE NOT NULL,
    "password" VARCHAR(255) NOT NULL,
    "created_at" DATE DEFAULT CURRENT_TIMESTAMP,
    "reset_token" VARCHAR(255) NULL,
    "reset_token_expiration" DATE NULL
);


CREATE TABLE "group" (
    "id" SERIAL PRIMARY KEY,
    "id_account" INT NOT NULL,
    "name" VARCHAR(255) NOT NULL,
    FOREIGN KEY ("id_account") REFERENCES "account" ("id") ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE "task" (
    "id_task" SERIAL PRIMARY KEY,
    "id_account" INT NOT NULL,
    "name" VARCHAR(255) NOT NULL,
    "description" TEXT NULL,
    "current_state" VARCHAR(50) NULL,
    "priority" INT NULL,
    "start_date" DATE NULL,
    "deadline" DATE NOT NULL,
    "end_date" DATE NULL,
    "id_group" INT NULL,
    FOREIGN KEY ("id_account") REFERENCES "account" ("id") ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY ("id_group") REFERENCES "group" ("id") ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE "comment" (
    "id" SERIAL PRIMARY KEY,
    "comment" TEXT NOT NULL,
    "id_task" INT NOT NULL,
    FOREIGN KEY ("id_task") REFERENCES "task" ("id_task") ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE "taskdependencies" (
    "id_mother_task" INT NOT NULL,
    "id_child_task" INT NOT NULL,
    PRIMARY KEY ("id_mother_task", "id_child_task"),
    FOREIGN KEY ("id_mother_task") REFERENCES "task" ("id_task") ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY ("id_child_task") REFERENCES "task" ("id_task") ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE "preferences" (
    "id" SERIAL PRIMARY KEY,
    "days_reminder_deadline" INT NOT NULL,
    "rows_per_page" INT NOT NULL,
    "pagination_pages" INT NOT NULL,
    "displayed_days_in_calendar" INT NOT NULL,
    "account_id" INT NOT NULL,
    CONSTRAINT fk_account FOREIGN KEY ("account_id") REFERENCES "account"("id") ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE OR REPLACE FUNCTION create_default_preferences()
RETURNS TRIGGER AS $$
BEGIN
    INSERT INTO "preferences" (
        "days_reminder_deadline",
        "rows_per_page",
        "pagination_pages",
        "displayed_days_in_calendar",
        "account_id"
    )
    VALUES (
        7,
        5,
        5,
        7,
        NEW.id
    );
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER after_account_insert
AFTER INSERT ON "account"
FOR EACH ROW
EXECUTE FUNCTION create_default_preferences();