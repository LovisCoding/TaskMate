<div align="center">
    <h1>TaskMate</h1>
</div>

<div align="center">
    <img src="./public/assets/imgs/Logo_TaskMate.svg" alt="TaskMate Logo" width="300">
</div>

<br>

**TaskMate** est une solution moderne et intuitive pour gérer vos tâches au quotidien. Conçue pour être à la fois simple et efficace, elle vous aide à mieux organiser votre temps et à prioriser vos objectifs.  

## 🌟 **Fonctionnalités clés**  
- **Ajouter des tâches** : Créez des tâches en quelques clics pour ne rien oublier.  
- **Marquer les tâches comme terminées** : Suivez vos progrès facilement.  
- **Supprimer des tâches** : Gardez une liste toujours à jour.  
- **Filtrer les tâches par statut** : Trouvez rapidement ce que vous cherchez.  

## 🚀 **Pourquoi choisir TaskMate ?**  
TaskMate se distingue par son interface claire et ses fonctionnalités pratiques qui répondent à vos besoins essentiels sans superflu. Que ce soit pour un usage personnel ou professionnel, TaskMate est conçu pour simplifier votre gestion des priorités, sans compromis sur l’efficacité.  

---

## 🛠️ **Installation**  

### 1. **Cloner le dépôt**  
Téléchargez le projet en local avec la commande suivante :  
```bash
git clone https://github.com/LovisCoding/TaskMate.git
```

### 2. **Accéder au projet**
Naviguez vers le dossier téléchargé :  
```bash
cd TaskMate
```

### 3. **Installer les dépendances**
Installez les bibliothèques nécessaires avec Composer :  
```bash
composer install
```

### 4. **Configurer CodeIgniter 4**
Copiez le fichier de configuration d'exemple :  
```bash
cp .env.example .env
```

### 5. **Configurer la base de données**
Modifiez le fichier .env en y ajoutant vos informations de connexion :
```bash
database.default.DSN =
database.default.hostname = localhost
database.default.database = votredb
database.default.username = votreuser
database.default.password = motdepasse
database.default.DBDriver = Postgre
database.default.port = 7777
```

### 6. **Créer la base de données**
Exécutez les migrations pour générer les tables nécessaires : 
```bash
php spark migrate
```

Si cette étape échoue, vous pouvez importer manuellement le fichier SQL init.sql situé à la racine du projet dans votre base de données.

### 7. **Lancer l'application**
Accédez à TaskMate via votre navigateur en vous rendant sur :
```bash
http://localhost:8080
```