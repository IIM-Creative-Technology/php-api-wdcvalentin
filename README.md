Bienvenue sur l'API de l'école Leonard de Vinci

## A PROPOS DE L'API

Les dates s'écrivent dans ce format : "February 28, 2021".

Les identifiants pour les membres de l'administration seront générés
avec les seeds.
Authentification JWT :
    POST : /api/auth/login => body : [email, password]
    POST : /api/auth/logout => body : token

Etudiants : 
    POST : /api/student => body : [first_name, last_name, age, class]
    GET : /api/students
    GET : /api/student/{id}
    PUT : /api/update-student/{id} => body : [first_name, last_name, age, class]
    DEL : /api/delete-student/{id}
    GET : /api/students-from-class/{className} => nom de la classe en QS.

Intervenants :
    POST : /api/create-teacher => body : [first_name, last_name, arrival_date]
    GET : /api/teachers
    GET : api/teacher/{id}
    PUT : /api/update-teacher/{id} body : [first_name, last_name, arrival_date]
    DEL : /api/delete-teacher/{id}

Matières :
    POST : /api/create-subject => body : [name, week_date, teacher (nom), school_class (nom)]
    GET : /api/subjects
    PUT : /api/update-subject/{id} body : [name, week_date, teacher (nom), school_class (nom)]
    DEL : /api/delete-subject/{id}

Classe :
    POST : /api/create-class => body : [name, year]
    GET : /api/classes
    GET : /api/class/{className}
    PUT : /api/update-class/{id} => body : [name, year]
    DEL : /api/delete-class/{id}

Notes :
    POST : /api/set-mark => body : [mark, student_id, schoolclass_id, subject_id]
    GET : /api/student-marks/{id}
    GET : /api/student-marks/student/{student_id}/subject/{subject_id}
    PUT : /api/update-mark/{id} => body : [mark, student_id, schoolclass_id, subject_id]
    DEL : /api/delete-mark/{id}

