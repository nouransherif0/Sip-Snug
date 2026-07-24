import os

def process_file(filepath):
    with open(filepath, 'r') as f:
        lines = f.readlines()
        
    out_lines = []
    for line in lines:
        stripped = line.strip()
        
        # Check if the previous line is already a comment to avoid double-commenting
        is_prev_comment = len(out_lines) > 0 and out_lines[-1].strip().startswith('//')
        
        if not is_prev_comment and not stripped.startswith('//'):
            indent = line[:len(line) - len(line.lstrip())]
            
            if stripped.startswith('class '):
                out_lines.append(indent + '// Defines the structure and properties of this class\n')
            elif stripped.startswith('public function rules()'):
                out_lines.append(indent + '// Specifies the validation rules that incoming data must pass\n')
            elif stripped.startswith('public function authorize()'):
                out_lines.append(indent + '// Checks if the current user has permission to perform this action\n')
            elif stripped.startswith('public function up()'):
                out_lines.append(indent + '// Runs when migrating the database to create or modify tables\n')
            elif stripped.startswith('public function down()'):
                out_lines.append(indent + '// Runs when rolling back the migration to drop tables\n')
            elif 'belongsTo(' in stripped and 'return' in stripped:
                out_lines.append(indent + '// Defines a relationship: this model belongs to a parent model\n')
            elif 'hasMany(' in stripped and 'return' in stripped:
                out_lines.append(indent + '// Defines a relationship: this model has many child models\n')
            elif 'belongsToMany(' in stripped and 'return' in stripped:
                out_lines.append(indent + '// Defines a Many-to-Many relationship using a pivot table\n')
            elif stripped.startswith('protected $fillable'):
                out_lines.append(indent + '// Defines which columns can be safely mass-assigned in the database\n')
            elif stripped.startswith('protected $table'):
                out_lines.append(indent + '// Explicitly links this model to a specific database table\n')
            elif 'Schema::create(' in stripped:
                out_lines.append(indent + '// Instructs the database to create a new table\n')
            elif '$table->id();' in stripped:
                out_lines.append(indent + '// Creates an auto-incrementing primary key column named ID\n')
            elif '$table->string(' in stripped:
                out_lines.append(indent + '// Creates a standard text string column in the database\n')
            elif '$table->foreignId(' in stripped:
                out_lines.append(indent + '// Creates a foreign key column to link this table to another table\n')
            elif '$table->timestamps();' in stripped:
                out_lines.append(indent + '// Automatically creates created_at and updated_at timestamp columns\n')

        out_lines.append(line)
        
    with open(filepath, 'w') as f:
        f.writelines(out_lines)

folders = [
    "app/Models",
    "app/Http/Requests",
    "app/Services",
    "database/migrations"
]

count = 0
for folder in folders:
    for root, dirs, files in os.walk(folder):
        for file in files:
            if file.endswith('.php'):
                process_file(os.path.join(root, file))
                count += 1

print(f"Successfully injected comments into {count} files!")
