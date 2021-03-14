Bienvenue sur l'API de l'école Leonard de Vinci

## Lancement

1. git clone https://github.com/IIM-Creative-Technology/php-api-wdcvalentin.git
2. cd php-api-wdcvalentin
3. composer install
4. modifier le .env en fonction de vos paramètres
5. php artisan migrate
6. php artisan db:seed
7. php artisan serve

## A PROPOS DE L'API

Les identifiants pour les membres de l'administration seront générés
avec les seeds.

lien postman de ma collection : https://www.getpostman.com/collections/c032b3d3876be5386147

Authentification JWT :
    1. POST : /api/auth/login => body : [email, password]
    2. POST : /api/auth/logout => body : token

Etudiants : 
    1. POST : /api/student => body : [first_name, last_name, age, class]
    2. GET : /api/students
    3. GET : /api/student/{id}
    4. PUT : /api/update-student/{id} => body : [first_name, last_name, age, class]
    5. DEL : /api/delete-student/{id}
    6. GET : /api/students-from-class/{className} => nom de la classe en QS.

Intervenants :
    1. POST : /api/create-teacher => body : [first_name, last_name, arrival_date]
    2. GET : /api/teachers
    3. GET : api/teacher/{id}
    4. PUT : /api/update-teacher/{id} body : [first_name, last_name, arrival_date]
    5. DEL : /api/delete-teacher/{id}

Matières :
    1. POST : /api/create-subject => body : [name, week_date, teacher (nom), school_class (nom)]
    2. GET : /api/subjects
    3. PUT : /api/update-subject/{id} body : [name, week_date, teacher (nom), school_class (nom)]
    4. DEL : /api/delete-subject/{id}

Classe :
    1. POST : /api/create-class => body : [name, year]
    2. GET : /api/classes
    3. GET : /api/class/{className}
    4. PUT : /api/update-class/{id} => body : [name, year]
    5. DEL : /api/delete-class/{id}

Notes :
    1. POST : /api/set-mark => body : [mark, student_id, schoolclass_id, subject_id]
    2. GET : /api/student-marks/{id}
    3. GET : /api/student-marks/student/{student_id}/subject/{subject_id}
    4. PUT : /api/update-mark/{id} => body : [mark, student_id, schoolclass_id, subject_id]
    5. DEL : /api/delete-mark/{id}

