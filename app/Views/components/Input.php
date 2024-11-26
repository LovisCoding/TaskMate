<?php 

function Input(string $label, string $placeholder, string $name, string $type): string {
    return "
        <div>
            <label for=\"$name\" class=\"form-label\">$label</label>
            <input type=\"$type\" class=\"form-control\" id=\"$name\" name=\"$name\" placeholder=\"$placeholder\">
        </div>
    ";
}
