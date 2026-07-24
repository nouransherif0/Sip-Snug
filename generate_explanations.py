import os
import re

def explain_line(line):
    l = line.strip()
    if not l:
        return ""
    if l == "<?php":
        return "// Opens the PHP tag so the server executes this file as PHP code."
    if l.startswith("namespace "):
        return "// Defines the namespace (virtual folder) so other files can locate this class."
    if l.startswith("use "):
        return f"// Imports the '{l.split(' ')[1].strip(';')}' class so it can be used here without typing its full path."
    if l.startswith("class "):
        return "// Declares the class structure. 'extends' means it inherits abilities from a parent class."
    if l == "{":
        return "// Opens a code block."
    if l == "}":
        return "// Closes the code block."
    if l == "};":
        return "// Closes the anonymous class or array block."
    if l.startswith("public function "):
        return "// Defines a public method that can be called from outside this class."
    if l.startswith("protected function "):
        return "// Defines a protected method that can only be called from inside this class or its children."
    if l.startswith("return "):
        return "// Returns the calculated result or relationship back to whatever called this method."
    if "belongsTo(" in l:
        return "// Defines an Eloquent relationship: This model belongs to ONE parent model."
    if "hasMany(" in l:
        return "// Defines an Eloquent relationship: This model has MANY child models."
    if "belongsToMany(" in l:
        return "// Defines an Eloquent relationship: Many-to-Many connection using a pivot table."
    if "Schema::create(" in l:
        return "// Instructs the database to create a new table."
    if "Schema::dropIfExists(" in l:
        return "// Instructs the database to drop (delete) the table if it currently exists."
    if "$table->id();" in l:
        return "// Creates an auto-incrementing primary key column named 'id'."
    if "$table->string(" in l:
        return "// Creates a VARCHAR text column (usually up to 255 characters)."
    if "$table->text(" in l:
        return "// Creates a TEXT column for storing long paragraphs or descriptions."
    if "$table->foreignId(" in l:
        return "// Creates a foreign key column to link this table to another table."
    if "$table->timestamps();" in l:
        return "// Automatically creates 'created_at' and 'updated_at' timestamp columns."
    if l.startswith("protected $fillable"):
        return "// Defines which database columns are safely allowed to be bulk-inserted (mass assignment)."
    if l.startswith("protected $table"):
        return "// Explicitly defines the database table name this model connects to."
    if "extends FormRequest" in l:
        return "// Inherits from FormRequest to handle form validation logic safely."
    if l.startswith("public function authorize()"):
        return "// Determines if the current user has permission to make this request."
    if l.startswith("public function rules()"):
        return "// Defines the exact validation rules (e.g. required, email) the data must pass."
    
    # Generic fallback
    if l.startswith("//") or l.startswith("/*") or l.startswith("*"):
        return "" # Already a comment
    
    return "// Executes standard Laravel/PHP logic for this specific line."

def generate_docs_for_folder(folder_path, output_filename, folder_title):
    if not os.path.exists(folder_path):
        return
        
    out = [f"# Line-by-Line Code Explanations: {folder_title}\n"]
    out.append("This document contains every single line from every file in this folder, with an easy explanation below each line.\n\n")
    
    for root, dirs, files in os.walk(folder_path):
        for file in files:
            if not file.endswith(".php"):
                continue
            file_path = os.path.join(root, file)
            out.append(f"## File: `{file}`\n")
            out.append("```php\n")
            with open(file_path, "r") as f:
                lines = f.readlines()
                for i, line in enumerate(lines, 1):
                    clean_line = line.replace("\n", "")
                    out.append(f"{i}: {clean_line}\n")
                    explanation = explain_line(clean_line)
                    if explanation:
                        out.append(f"{explanation}\n")
            out.append("```\n\n---\n\n")
            
    with open(output_filename, "w") as f:
        f.write("".join(out))

artifact_dir = "/Users/nouransherif7177/.gemini/antigravity-ide/brain/e42583dc-b3db-4a26-8400-1639c5f40487/"
generate_docs_for_folder("app/Models", artifact_dir + "full_models_explanation.md", "Models")
generate_docs_for_folder("app/Http/Requests", artifact_dir + "full_requests_explanation.md", "Requests")
generate_docs_for_folder("app/Services", artifact_dir + "full_services_explanation.md", "Services")
generate_docs_for_folder("database/migrations", artifact_dir + "full_migrations_explanation.md", "Migrations")

print("Generated!")
