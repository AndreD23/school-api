# School - API

[Instructions in portuguese](https://github.com/emtudo/school-api/blob/master/readme-pt.md)

## What is the project about?
 - Student Enrollment Management
 - [SPA to use this API](https://github.com/emtudo/school-spa)

## Features

### Access

* Student
* Responsible (Parents)
* Teachers
* Administradors (Directs of the all schools)

### Registers

* Schools
* Parents
* Teachers
* Students
* Enrollments
* Transports
  - Vehicles
  - Drivers
  - Routes
* Classes
  - Enrollments
  - Frequencies
  - Grades
  - Subjects
  - Quizzes
* Calendars
  - School calendar

### Rules

* Registers

  Before registering a student, the Student Mother will be registered.
  A mother can have children of different parents.

* CLASSES
  Associate Classes with Matters, being able to select the teachers enrolled for that subject and valuing if the teacher not associated to another class or school in the selected period.
  Associate Professor with Subjects;
  Address the issue of substitute teacher;

* Enrollments
  You can enroll a student in a class, OR, enroll several at a time, that is, at the end of the year, approved students may migrate from grade 3 to grade 4.

* Transports
  Create transport routes.
  Link students to routes.

* Teachers
  Release of absences, removals and attestations.

### Dashboard

* Widgets

### Dependencies
  - php 7.2
  - mysql 5.7
  - redis

### php extensions

Some php extensions are required. I recommend installing the extensions below, although not all of them are mandatory in this project:

```shell
php7.2-bcmath \
php7.2-common \
php7.2-cgi \
php7.2-curl \
php7.2-dev \
php7.2-gd \
php7.2-intl \
php7.2-json \
php7.2-mysql \
php7.2-mbstring \
php7.2-pgsql \
php7.2-sqlite3 \
php7.2-xml \
php7.2-zip \
php-apcu \
php-imagick \
php-memcached \
php-redis
```

### How to install

[Installation video in Portuguese](https://www.youtube.com/watch?v=RHxsmFYcmIc)

[Demo video in Portuguese](https://www.youtube.com/watch?v=QXI84A-QnUA&t=136s)

```shell
composer create-project emtudo/school-api
cd school-api
php artisan jwt:generate
```

Configure the `.env` file before executing the command below to create the database tables:

```shell
php artisan migrator
```

### How to test

```shell
php artisan serve
```

### Admin (Default)

- username: admin@user.com
- password: abc123


### Routes

| Method | URI                                             | Action                                                                         | Middleware                                                                               |
| ------ | ----------------------------------------------- | ------------------------------------------------------------------------------ | ---------------------------------------------------------------------------------------- |
| GET\| HEAD                                            | /                                                                    | Emtudo\Units\Core\Http\Controllers\WelcomeController@index                               | Closure                                             |
| POST   | auth/login                                      | Emtudo\Units\Auth\Http\Controllers\LoginController@login                       | api,Closure                                                                              |                                                     |
| POST   | auth/password/email                             | Emtudo\Units\Auth\Http\Controllers\ForgotPasswordController@sendResetLinkEmail | api,Closure                                                                              |                                                     |
| POST   | auth/password/reset                             | Emtudo\Units\Auth\Http\Controllers\ResetPasswordController@reset               | api,Closure                                                                              |                                                     |
| POST   | auth/refresh                                    | Emtudo\Units\Auth\Http\Controllers\LoginController@refresh                     | api,Closure                                                                              |                                                     |
| GET\| HEAD                                            | responsible/users/students                                           | Emtudo\Units\Responsible\Users\Http\Controllers\StudentController@index                  | api,auth,responsible,Closure                        |
| PUT    | responsible/users/students/{user}               | Emtudo\Units\Responsible\Users\Http\Controllers\StudentController@update       | api,auth,responsible,Closure                                                             |                                                     |
| GET\| HEAD                                            | responsible/users/students/{user}                                    | Emtudo\Units\Responsible\Users\Http\Controllers\StudentController@show                   | api,auth,responsible,Closure                        |
| PUT    | responsible/users/users/me                      | Emtudo\Units\Responsible\Users\Http\Controllers\UserController@updateMe        | api,auth,responsible,Closure                                                             |                                                     |
| GET\| HEAD                                            | responsible/users/users/me                                           | Emtudo\Units\Responsible\Users\Http\Controllers\UserController@showMe                    | api,auth,responsible,Closure                        |
| DELETE | responsible/users/users/{user}/documents/{kind} | Emtudo\Units\Responsible\Users\Http\Controllers\UserController@destroyDocument | api,auth,responsible,Closure                                                             |                                                     |
| GET\| HEAD                                            | responsible/users/users/{user}/documents/{kind}                      | Emtudo\Units\Responsible\Users\Http\Controllers\UserController@getDocumetByKind          | api,auth,responsible,Closure                        |
| GET\| HEAD                                            | responsible/users/{student}/groups/{group}/frequencies/month/{month} | Emtudo\Units\Responsible\Users\Http\Controllers\FrequencyController@getByGroup           | api,auth,responsible,responsible_of_student,Closure |
| GET\| HEAD                                            | responsible/users/{student}/groups/{group}/grades                    | Emtudo\Units\Responsible\Users\Http\Controllers\GradeController@getByGroup               | api,auth,responsible,responsible_of_student,Closure |
| GET\| HEAD                                            | school/calendars/calendars                                           | Emtudo\Units\School\Calendars\Http\Controllers\CalendarController@index                  | api,auth,admin,Closure                              |
| POST   | school/calendars/calendars                      | Emtudo\Units\School\Calendars\Http\Controllers\CalendarController@store        | api,auth,admin,Closure                                                                   |                                                     |
| GET\| HEAD                                            | school/calendars/calendars/{calendar}                                | Emtudo\Units\School\Calendars\Http\Controllers\CalendarController@show                   | api,auth,admin,Closure                              |
| PUT\| PATCH                                           | school/calendars/calendars/{calendar}                                | Emtudo\Units\School\Calendars\Http\Controllers\CalendarController@update                 | api,auth,admin,Closure                              |
| DELETE | school/calendars/calendars/{calendar}           | Emtudo\Units\School\Calendars\Http\Controllers\CalendarController@destroy      | api,auth,admin,Closure                                                                   |                                                     |
| GET\| HEAD                                            | school/calendars/events                                              | Emtudo\Units\School\Calendars\Http\Controllers\EventController@index                     | api,auth,admin,Closure                              |
| POST   | school/calendars/events                         | Emtudo\Units\School\Calendars\Http\Controllers\EventController@store           | api,auth,admin,Closure                                                                   |                                                     |
| GET\| HEAD                                            | school/calendars/events/{event}                                      | Emtudo\Units\School\Calendars\Http\Controllers\EventController@show                      | api,auth,admin,Closure                              |
| PUT\| PATCH                                           | school/calendars/events/{event}                                      | Emtudo\Units\School\Calendars\Http\Controllers\EventController@update                    | api,auth,admin,Closure                              |
| DELETE | school/calendars/events/{event}                 | Emtudo\Units\School\Calendars\Http\Controllers\EventController@destroy         | api,auth,admin,Closure                                                                   |                                                     |
| GET\| HEAD                                            | school/calendars/school_days/holidays_from_year/{year}               | Emtudo\Units\School\Calendars\Http\Controllers\SchoolDayController@holidaysFromYear      | api,auth,admin,Closure                              |
| GET\| HEAD                                            | school/calendars/school_days/holidays_in_current_year                | Emtudo\Units\School\Calendars\Http\Controllers\SchoolDayController@holidaysInCurrentYear | api,auth,admin,Closure                              |
| PUT    | school/calendars/school_days/toggle             | Emtudo\Units\School\Calendars\Http\Controllers\SchoolDayController@toggle      | api,auth,admin,Closure                                                                   |                                                     |
| POST   | school/calendars/two_months                     | Emtudo\Units\School\Calendars\Http\Controllers\TwoMonthController@store        | api,auth,admin,Closure                                                                   |                                                     |
| GET\| HEAD                                            | school/calendars/two_months                                          | Emtudo\Units\School\Calendars\Http\Controllers\TwoMonthController@index                  | api,auth,admin,Closure                              |
| GET\| HEAD                                            | school/calendars/two_months/{two_month}                              | Emtudo\Units\School\Calendars\Http\Controllers\TwoMonthController@show                   | api,auth,admin,Closure                              |
| PUT    | school/calendars/two_months/{two_month}         | Emtudo\Units\School\Calendars\Http\Controllers\TwoMonthController@update       | api,auth,admin,Closure                                                                   |                                                     |
| POST   | school/courses/courses                          | Emtudo\Units\School\Courses\Http\Controllers\CourseController@store            | api,auth,admin,Closure                                                                   |                                                     |
| GET\| HEAD                                            | school/courses/courses                                               | Emtudo\Units\School\Courses\Http\Controllers\CourseController@index                      | api,auth,admin,Closure                              |
| DELETE | school/courses/courses/{course}                 | Emtudo\Units\School\Courses\Http\Controllers\CourseController@destroy          | api,auth,admin,Closure                                                                   |                                                     |
| PUT\| PATCH                                           | school/courses/courses/{course}                                      | Emtudo\Units\School\Courses\Http\Controllers\CourseController@update                     | api,auth,admin,Closure                              |
| GET\| HEAD                                            | school/courses/courses/{course}                                      | Emtudo\Units\School\Courses\Http\Controllers\CourseController@show                       | api,auth,admin,Closure                              |
| POST   | school/courses/enrollments                      | Emtudo\Units\School\Courses\Http\Controllers\EnrollmentController@store        | api,auth,admin,Closure                                                                   |                                                     |
| GET\| HEAD                                            | school/courses/enrollments                                           | Emtudo\Units\School\Courses\Http\Controllers\EnrollmentController@index                  | api,auth,admin,Closure                              |
| DELETE | school/courses/enrollments/{enrollment}         | Emtudo\Units\School\Courses\Http\Controllers\EnrollmentController@destroy      | api,auth,admin,Closure                                                                   |                                                     |
| PUT\| PATCH                                           | school/courses/enrollments/{enrollment}                              | Emtudo\Units\School\Courses\Http\Controllers\EnrollmentController@update                 | api,auth,admin,Closure                              |
| GET\| HEAD                                            | school/courses/enrollments/{enrollment}                              | Emtudo\Units\School\Courses\Http\Controllers\EnrollmentController@show                   | api,auth,admin,Closure                              |
| POST   | school/courses/frequencies                      | Emtudo\Units\School\Courses\Http\Controllers\FrequencyController@store         | api,auth,admin,Closure                                                                   |                                                     |
| GET\| HEAD                                            | school/courses/frequencies                                           | Emtudo\Units\School\Courses\Http\Controllers\FrequencyController@index                   | api,auth,admin,Closure                              |
| POST   | school/courses/frequencies/several              | Emtudo\Units\School\Courses\Http\Controllers\FrequencyController@storeSeveral  | api,auth,admin,Closure                                                                   |                                                     |
| DELETE | school/courses/frequencies/{frequency}          | Emtudo\Units\School\Courses\Http\Controllers\FrequencyController@destroy       | api,auth,admin,Closure                                                                   |                                                     |
| PUT\| PATCH                                           | school/courses/frequencies/{frequency}                               | Emtudo\Units\School\Courses\Http\Controllers\FrequencyController@update                  | api,auth,admin,Closure                              |
| GET\| HEAD                                            | school/courses/frequencies/{frequency}                               | Emtudo\Units\School\Courses\Http\Controllers\FrequencyController@show                    | api,auth,admin,Closure                              |
| POST   | school/courses/grades                           | Emtudo\Units\School\Courses\Http\Controllers\GradeController@store             | api,auth,admin,Closure                                                                   |                                                     |
| GET\| HEAD                                            | school/courses/grades                                                | Emtudo\Units\School\Courses\Http\Controllers\GradeController@index                       | api,auth,admin,Closure                              |
| POST   | school/courses/grades/several                   | Emtudo\Units\School\Courses\Http\Controllers\GradeController@storeSeveral      | api,auth,admin,Closure                                                                   |                                                     |
| GET\| HEAD                                            | school/courses/grades/{grade}                                        | Emtudo\Units\School\Courses\Http\Controllers\GradeController@show                        | api,auth,admin,Closure                              |
| PUT\| PATCH                                           | school/courses/grades/{grade}                                        | Emtudo\Units\School\Courses\Http\Controllers\GradeController@update                      | api,auth,admin,Closure                              |
| DELETE | school/courses/grades/{grade}                   | Emtudo\Units\School\Courses\Http\Controllers\GradeController@destroy           | api,auth,admin,Closure                                                                   |                                                     |
| GET\| HEAD                                            | school/courses/groups                                                | Emtudo\Units\School\Courses\Http\Controllers\GroupController@index                       | api,auth,admin,Closure                              |
| POST   | school/courses/groups                           | Emtudo\Units\School\Courses\Http\Controllers\GroupController@store             | api,auth,admin,Closure                                                                   |                                                     |
| DELETE | school/courses/groups/{group}                   | Emtudo\Units\School\Courses\Http\Controllers\GroupController@destroy           | api,auth,admin,Closure                                                                   |                                                     |
| GET\| HEAD                                            | school/courses/groups/{group}                                        | Emtudo\Units\School\Courses\Http\Controllers\GroupController@show                        | api,auth,admin,Closure                              |
| PUT\| PATCH                                           | school/courses/groups/{group}                                        | Emtudo\Units\School\Courses\Http\Controllers\GroupController@update                      | api,auth,admin,Closure                              |
| POST   | school/courses/questions                        | Emtudo\Units\School\Courses\Http\Controllers\QuestionController@store          | api,auth,admin,Closure                                                                   |                                                     |
| GET\| HEAD                                            | school/courses/questions                                             | Emtudo\Units\School\Courses\Http\Controllers\QuestionController@index                    | api,auth,admin,Closure                              |
| GET\| HEAD                                            | school/courses/questions/{question}                                  | Emtudo\Units\School\Courses\Http\Controllers\QuestionController@show                     | api,auth,admin,Closure                              |
| PUT\| PATCH                                           | school/courses/questions/{question}                                  | Emtudo\Units\School\Courses\Http\Controllers\QuestionController@update                   | api,auth,admin,Closure                              |
| DELETE | school/courses/questions/{question}             | Emtudo\Units\School\Courses\Http\Controllers\QuestionController@destroy        | api,auth,admin,Closure                                                                   |                                                     |
| GET\| HEAD                                            | school/courses/quizzes                                               | Emtudo\Units\School\Courses\Http\Controllers\QuizController@index                        | api,auth,admin,Closure                              |
| POST   | school/courses/quizzes                          | Emtudo\Units\School\Courses\Http\Controllers\QuizController@store              | api,auth,admin,Closure                                                                   |                                                     |
| DELETE | school/courses/quizzes/{quiz}                   | Emtudo\Units\School\Courses\Http\Controllers\QuizController@destroy            | api,auth,admin,Closure                                                                   |                                                     |
| GET\| HEAD                                            | school/courses/quizzes/{quiz}                                        | Emtudo\Units\School\Courses\Http\Controllers\QuizController@show                         | api,auth,admin,Closure                              |
| PUT\| PATCH                                           | school/courses/quizzes/{quiz}                                        | Emtudo\Units\School\Courses\Http\Controllers\QuizController@update                       | api,auth,admin,Closure                              |
| GET\| HEAD                                            | school/courses/schedules                                             | Emtudo\Units\School\Courses\Http\Controllers\ScheduleController@index                    | api,auth,admin,Closure                              |
| POST   | school/courses/schedules                        | Emtudo\Units\School\Courses\Http\Controllers\ScheduleController@store          | api,auth,admin,Closure                                                                   |                                                     |
| DELETE | school/courses/schedules/{schedule}             | Emtudo\Units\School\Courses\Http\Controllers\ScheduleController@destroy        | api,auth,admin,Closure                                                                   |                                                     |
| GET\| HEAD                                            | school/courses/schedules/{schedule}                                  | Emtudo\Units\School\Courses\Http\Controllers\ScheduleController@show                     | api,auth,admin,Closure                              |
| PUT\| PATCH                                           | school/courses/schedules/{schedule}                                  | Emtudo\Units\School\Courses\Http\Controllers\ScheduleController@update                   | api,auth,admin,Closure                              |
| POST   | school/courses/skills                           | Emtudo\Units\School\Courses\Http\Controllers\SkillController@store             | api,auth,admin,Closure                                                                   |                                                     |
| GET\| HEAD                                            | school/courses/skills                                                | Emtudo\Units\School\Courses\Http\Controllers\SkillController@index                       | api,auth,admin,Closure                              |
| GET\| HEAD                                            | school/courses/skills/{skill}                                        | Emtudo\Units\School\Courses\Http\Controllers\SkillController@show                        | api,auth,admin,Closure                              |
| PUT\| PATCH                                           | school/courses/skills/{skill}                                        | Emtudo\Units\School\Courses\Http\Controllers\SkillController@update                      | api,auth,admin,Closure                              |
| DELETE | school/courses/skills/{skill}                   | Emtudo\Units\School\Courses\Http\Controllers\SkillController@destroy           | api,auth,admin,Closure                                                                   |                                                     |
| GET\| HEAD                                            | school/courses/subjects                                              | Emtudo\Units\School\Courses\Http\Controllers\SubjectController@index                     | api,auth,admin,Closure                              |
| POST   | school/courses/subjects                         | Emtudo\Units\School\Courses\Http\Controllers\SubjectController@store           | api,auth,admin,Closure                                                                   |                                                     |
| GET\| HEAD                                            | school/courses/subjects/{subject}                                    | Emtudo\Units\School\Courses\Http\Controllers\SubjectController@show                      | api,auth,admin,Closure                              |
| DELETE | school/courses/subjects/{subject}               | Emtudo\Units\School\Courses\Http\Controllers\SubjectController@destroy         | api,auth,admin,Closure                                                                   |                                                     |
| PUT\| PATCH                                           | school/courses/subjects/{subject}                                    | Emtudo\Units\School\Courses\Http\Controllers\SubjectController@update                    | api,auth,admin,Closure                              |
| GET\| HEAD                                            | school/dashboard                                                     | Emtudo\Units\School\Dashboard\Http\Controllers\DashboardController@index                 | api,auth,admin,Closure                              |
| GET\| HEAD                                            | school/schools/schools                                               | Emtudo\Units\School\Schools\Http\Controllers\SchoolController@index                      | api,auth,admin,Closure                              |
| POST   | school/schools/schools                          | Emtudo\Units\School\Schools\Http\Controllers\SchoolController@store            | api,auth,admin,Closure                                                                   |                                                     |
| GET\| HEAD                                            | school/schools/schools/{school}                                      | Emtudo\Units\School\Schools\Http\Controllers\SchoolController@show                       | api,auth,admin,Closure                              |
| DELETE | school/schools/schools/{school}                 | Emtudo\Units\School\Schools\Http\Controllers\SchoolController@destroy          | api,auth,admin,Closure                                                                   |                                                     |
| PUT\| PATCH                                           | school/schools/schools/{school}                                      | Emtudo\Units\School\Schools\Http\Controllers\SchoolController@update                     | api,auth,admin,Closure                              |
| GET\| HEAD                                            | school/transports/routes                                             | Emtudo\Units\School\Transports\Http\Controllers\RouteController@index                    | api,auth,admin,Closure                              |
| POST   | school/transports/routes                        | Emtudo\Units\School\Transports\Http\Controllers\RouteController@store          | api,auth,admin,Closure                                                                   |                                                     |
| DELETE | school/transports/routes/{route}                | Emtudo\Units\School\Transports\Http\Controllers\RouteController@destroy        | api,auth,admin,Closure                                                                   |                                                     |
| PUT\| PATCH                                           | school/transports/routes/{route}                                     | Emtudo\Units\School\Transports\Http\Controllers\RouteController@update                   | api,auth,admin,Closure                              |
| GET\| HEAD                                            | school/transports/routes/{route}                                     | Emtudo\Units\School\Transports\Http\Controllers\RouteController@show                     | api,auth,admin,Closure                              |
| POST   | school/transports/stops                         | Emtudo\Units\School\Transports\Http\Controllers\StopController@store           | api,auth,admin,Closure                                                                   |                                                     |
| GET\| HEAD                                            | school/transports/stops                                              | Emtudo\Units\School\Transports\Http\Controllers\StopController@index                     | api,auth,admin,Closure                              |
| GET\| HEAD                                            | school/transports/stops/{stop}                                       | Emtudo\Units\School\Transports\Http\Controllers\StopController@show                      | api,auth,admin,Closure                              |
| PUT\| PATCH                                           | school/transports/stops/{stop}                                       | Emtudo\Units\School\Transports\Http\Controllers\StopController@update                    | api,auth,admin,Closure                              |
| DELETE | school/transports/stops/{stop}                  | Emtudo\Units\School\Transports\Http\Controllers\StopController@destroy         | api,auth,admin,Closure                                                                   |                                                     |
| GET\| HEAD                                            | school/transports/vehicles                                           | Emtudo\Units\School\Transports\Http\Controllers\VehicleController@index                  | api,auth,admin,Closure                              |
| POST   | school/transports/vehicles                      | Emtudo\Units\School\Transports\Http\Controllers\VehicleController@store        | api,auth,admin,Closure                                                                   |                                                     |
| DELETE | school/transports/vehicles/{vehicle}            | Emtudo\Units\School\Transports\Http\Controllers\VehicleController@destroy      | api,auth,admin,Closure                                                                   |                                                     |
| GET\| HEAD                                            | school/transports/vehicles/{vehicle}                                 | Emtudo\Units\School\Transports\Http\Controllers\VehicleController@show                   | api,auth,admin,Closure                              |
| PUT\| PATCH                                           | school/transports/vehicles/{vehicle}                                 | Emtudo\Units\School\Transports\Http\Controllers\VehicleController@update                 | api,auth,admin,Closure                              |
| POST   | school/users/managers                           | Emtudo\Units\School\Users\Http\Controllers\ManagerController@store             | api,auth,admin,Closure                                                                   |                                                     |
| GET\| HEAD                                            | school/users/managers                                                | Emtudo\Units\School\Users\Http\Controllers\ManagerController@index                       | api,auth,admin,Closure                              |
| PUT\| PATCH                                           | school/users/managers/{manager}                                      | Emtudo\Units\School\Users\Http\Controllers\ManagerController@update                      | api,auth,admin,Closure                              |
| GET\| HEAD                                            | school/users/managers/{manager}                                      | Emtudo\Units\School\Users\Http\Controllers\ManagerController@show                        | api,auth,admin,Closure                              |
| DELETE | school/users/managers/{manager}                 | Emtudo\Units\School\Users\Http\Controllers\ManagerController@destroy           | api,auth,admin,Closure                                                                   |                                                     |
| POST   | school/users/responsibles                       | Emtudo\Units\School\Users\Http\Controllers\ResponsibleController@store         | api,auth,admin,Closure                                                                   |                                                     |
| GET\| HEAD                                            | school/users/responsibles                                            | Emtudo\Units\School\Users\Http\Controllers\ResponsibleController@index                   | api,auth,admin,Closure                              |
| DELETE | school/users/responsibles/{responsible}         | Emtudo\Units\School\Users\Http\Controllers\ResponsibleController@destroy       | api,auth,admin,Closure                                                                   |                                                     |
| PUT\| PATCH                                           | school/users/responsibles/{responsible}                              | Emtudo\Units\School\Users\Http\Controllers\ResponsibleController@update                  | api,auth,admin,Closure                              |
| GET\| HEAD                                            | school/users/responsibles/{responsible}                              | Emtudo\Units\School\Users\Http\Controllers\ResponsibleController@show                    | api,auth,admin,Closure                              |
| GET\| HEAD                                            | school/users/students                                                | Emtudo\Units\School\Users\Http\Controllers\StudentController@index                       | api,auth,admin,Closure                              |
| POST   | school/users/students                           | Emtudo\Units\School\Users\Http\Controllers\StudentController@store             | api,auth,admin,Closure                                                                   |                                                     |
| DELETE | school/users/students/{student}                 | Emtudo\Units\School\Users\Http\Controllers\StudentController@destroy           | api,auth,admin,Closure                                                                   |                                                     |
| PUT\| PATCH                                           | school/users/students/{student}                                      | Emtudo\Units\School\Users\Http\Controllers\StudentController@update                      | api,auth,admin,Closure                              |
| GET\| HEAD                                            | school/users/students/{student}                                      | Emtudo\Units\School\Users\Http\Controllers\StudentController@show                        | api,auth,admin,Closure                              |
| POST   | school/users/teachers                           | Emtudo\Units\School\Users\Http\Controllers\TeacherController@store             | api,auth,admin,Closure                                                                   |                                                     |
| GET\| HEAD                                            | school/users/teachers                                                | Emtudo\Units\School\Users\Http\Controllers\TeacherController@index                       | api,auth,admin,Closure                              |
| DELETE | school/users/teachers/{teacher}                 | Emtudo\Units\School\Users\Http\Controllers\TeacherController@destroy           | api,auth,admin,Closure                                                                   |                                                     |
| GET\| HEAD                                            | school/users/teachers/{teacher}                                      | Emtudo\Units\School\Users\Http\Controllers\TeacherController@show                        | api,auth,admin,Closure                              |
| PUT\| PATCH                                           | school/users/teachers/{teacher}                                      | Emtudo\Units\School\Users\Http\Controllers\TeacherController@update                      | api,auth,admin,Closure                              |
| GET\| HEAD                                            | school/users/users                                                   | Emtudo\Units\School\Users\Http\Controllers\UserController@index                          | api,auth,admin,Closure                              |
| POST   | school/users/users                              | Emtudo\Units\School\Users\Http\Controllers\UserController@store                | api,auth,admin,Closure                                                                   |                                                     |
| GET\| HEAD                                            | school/users/users/me                                                | Emtudo\Units\School\Users\Http\Controllers\UserController@showMe                         | api,auth,admin,Closure                              |
| PUT    | school/users/users/me                           | Emtudo\Units\School\Users\Http\Controllers\UserController@updateMe             | api,auth,admin,Closure                                                                   |                                                     |
| GET\| HEAD                                            | school/users/users/{user}                                            | Emtudo\Units\School\Users\Http\Controllers\UserController@show                           | api,auth,admin,Closure                              |
| PUT\| PATCH                                           | school/users/users/{user}                                            | Emtudo\Units\School\Users\Http\Controllers\UserController@update                         | api,auth,admin,Closure                              |
| DELETE | school/users/users/{user}                       | Emtudo\Units\School\Users\Http\Controllers\UserController@destroy              | api,auth,admin,Closure                                                                   |                                                     |
| GET\| HEAD                                            | school/users/users/{user}/documents/{kind}                           | Emtudo\Units\School\Users\Http\Controllers\UserController@getDocumetByKind               | api,auth,admin,Closure                              |
| DELETE | school/users/users/{user}/documents/{kind}      | Emtudo\Units\School\Users\Http\Controllers\UserController@destroyDocument      | api,auth,admin,Closure                                                                   |                                                     |
| GET\| HEAD                                            | settings/profile/me                                                  | Emtudo\Units\Settings\Http\Controllers\ProfileController@show                            | api,auth,Closure                                    |
| PUT    | settings/profile/me                             | Emtudo\Units\Settings\Http\Controllers\ProfileController@update                | api,auth,Closure                                                                         |                                                     |
| GET\| HEAD                                            | settings/profile/me/documents/{kind}                                 | Emtudo\Units\Settings\Http\Controllers\DocumentController@getDocumetByKind               | api,auth,Closure                                    |
| DELETE | settings/profile/me/documents/{kind}            | Emtudo\Units\Settings\Http\Controllers\DocumentController@destroy              | api,auth,Closure                                                                         |                                                     |
| POST   | settings/users/me/avatars                       | Emtudo\Units\Settings\Http\Controllers\AvatarController@update                 | api,auth,Closure                                                                         |                                                     |
| POST   | settings/users/me/documents                     | Emtudo\Units\Settings\Http\Controllers\DocumentController@update               | api,auth,Closure                                                                         |                                                     |
| POST   | settings/users/{user}/avatars                   | Emtudo\Units\Settings\Http\Controllers\AvatarController@updateUser             | api,auth,Closure                                                                         |                                                     |
| POST   | settings/users/{user}/documents                 | Emtudo\Units\Settings\Http\Controllers\DocumentController@updateUser           | api,auth,Closure                                                                         |                                                     |
| GET\| HEAD                                            | student/courses/courses                                              | Emtudo\Units\Student\Courses\Http\Controllers\CourseController@index                     | api,auth,Closure                                    |
| GET\| HEAD                                            | student/courses/courses/{course}                                     | Emtudo\Units\Student\Courses\Http\Controllers\CourseController@show                      | api,auth,Closure                                    |
| GET\| HEAD                                            | student/courses/enrollments                                          | Emtudo\Units\Student\Courses\Http\Controllers\EnrollmentController@index                 | api,auth,Closure                                    |
| GET\| HEAD                                            | student/courses/enrollments/{enrollment}                             | Emtudo\Units\Student\Courses\Http\Controllers\EnrollmentController@show                  | api,auth,Closure                                    |
| GET\| HEAD                                            | student/courses/groups                                               | Emtudo\Units\Student\Courses\Http\Controllers\GroupController@index                      | api,auth,Closure                                    |
| GET\| HEAD                                            | student/courses/groups/{group}                                       | Emtudo\Units\Student\Courses\Http\Controllers\GroupController@show                       | api,auth,Closure                                    |
| GET\| HEAD                                            | student/courses/questions                                            | Emtudo\Units\Student\Courses\Http\Controllers\QuestionController@index                   | api,auth,Closure                                    |
| GET\| HEAD                                            | student/courses/questions/{question}                                 | Emtudo\Units\Student\Courses\Http\Controllers\QuestionController@show                    | api,auth,Closure                                    |
| GET\| HEAD                                            | student/courses/quizzes                                              | Emtudo\Units\Student\Courses\Http\Controllers\QuizController@index                       | api,auth,Closure                                    |
| GET\| HEAD                                            | student/courses/quizzes/{quiz}                                       | Emtudo\Units\Student\Courses\Http\Controllers\QuizController@show                        | api,auth,Closure                                    |
| GET\| HEAD                                            | student/courses/schedules                                            | Emtudo\Units\Student\Courses\Http\Controllers\ScheduleController@index                   | api,auth,Closure                                    |
| GET\| HEAD                                            | student/courses/schedules/{schedule}                                 | Emtudo\Units\Student\Courses\Http\Controllers\ScheduleController@show                    | api,auth,Closure                                    |
| GET\| HEAD                                            | student/schools/schools                                              | Emtudo\Units\Student\Schools\Http\Controllers\SchoolController@index                     | api,auth,Closure                                    |
| GET\| HEAD                                            | student/schools/schools/{school}                                     | Emtudo\Units\Student\Schools\Http\Controllers\SchoolController@show                      | api,auth,Closure                                    |
| GET\| HEAD                                            | student/transports/routes                                            | Emtudo\Units\Student\Transports\Http\Controllers\RouteController@index                   | api,auth,Closure                                    |
| GET\| HEAD                                            | student/transports/routes/{route}                                    | Emtudo\Units\Student\Transports\Http\Controllers\RouteController@show                    | api,auth,Closure                                    |
| GET\| HEAD                                            | student/transports/stops                                             | Emtudo\Units\Student\Transports\Http\Controllers\StopController@index                    | api,auth,Closure                                    |
| GET\| HEAD                                            | student/transports/stops/{stop}                                      | Emtudo\Units\Student\Transports\Http\Controllers\StopController@show                     | api,auth,Closure                                    |
| GET\| HEAD                                            | student/transports/vehicles                                          | Emtudo\Units\Student\Transports\Http\Controllers\VehicleController@index                 | api,auth,Closure                                    |
| GET\| HEAD                                            | student/transports/vehicles/{vehicle}                                | Emtudo\Units\Student\Transports\Http\Controllers\VehicleController@show                  | api,auth,Closure                                    |
| GET\| HEAD                                            | student/users/me/groups/{group}/frequencies/month/{month}            | Emtudo\Units\Student\Users\Http\Controllers\FrequencyController@getByGroupFromMe         | api,auth,admin,Closure                              |
| GET\| HEAD                                            | student/users/me/groups/{group}/grades                               | Emtudo\Units\Student\Users\Http\Controllers\GradeController@getByGroupFromMe             | api,auth,admin,Closure                              |
| GET\| HEAD                                            | student/users/users/me                                               | Emtudo\Units\Student\Users\Http\Controllers\UserController@showMe                        | api,auth,admin,Closure                              |
| PUT    | student/users/users/me                          | Emtudo\Units\Student\Users\Http\Controllers\UserController@updateMe            | api,auth,admin,Closure                                                                   |                                                     |
| DELETE | student/users/users/{user}/documents/{kind}     | Emtudo\Units\Student\Users\Http\Controllers\UserController@destroyDocument     | api,auth,admin,Closure                                                                   |                                                     |
| GET\| HEAD                                            | student/users/users/{user}/documents/{kind}                          | Emtudo\Units\Student\Users\Http\Controllers\UserController@getDocumetByKind              | api,auth,admin,Closure                              |
| GET\| HEAD                                            | student/users/{student}/groups/{group}/frequencies/month/{month}     | Emtudo\Units\Student\Users\Http\Controllers\FrequencyController@getByGroup               | api,auth,admin,responsible_of_student,Closure       |
| GET\| HEAD                                            | student/users/{student}/groups/{group}/grades                        | Emtudo\Units\Student\Users\Http\Controllers\GradeController@getByGroup                   | api,auth,admin,responsible_of_student,Closure       |
| POST   | teacher/courses/frequencies                     | Emtudo\Units\Teacher\Courses\Http\Controllers\FrequencyController@store        | api,auth,teacher,Closure                                                                 |                                                     |
| GET\| HEAD                                            | teacher/courses/frequencies                                          | Emtudo\Units\Teacher\Courses\Http\Controllers\FrequencyController@index                  | api,auth,teacher,Closure                            |
| POST   | teacher/courses/frequencies/several             | Emtudo\Units\Teacher\Courses\Http\Controllers\FrequencyController@storeSeveral | api,auth,teacher,Closure                                                                 |                                                     |
| GET\| HEAD                                            | teacher/courses/frequencies/{frequency}                              | Emtudo\Units\Teacher\Courses\Http\Controllers\FrequencyController@show                   | api,auth,teacher,Closure                            |
| PUT\| PATCH                                           | teacher/courses/frequencies/{frequency}                              | Emtudo\Units\Teacher\Courses\Http\Controllers\FrequencyController@update                 | api,auth,teacher,Closure                            |
| DELETE | teacher/courses/frequencies/{frequency}         | Emtudo\Units\Teacher\Courses\Http\Controllers\FrequencyController@destroy      | api,auth,teacher,Closure                                                                 |                                                     |
| POST   | teacher/courses/grades                          | Emtudo\Units\Teacher\Courses\Http\Controllers\GradeController@store            | api,auth,teacher,Closure                                                                 |                                                     |
| GET\| HEAD                                            | teacher/courses/grades                                               | Emtudo\Units\Teacher\Courses\Http\Controllers\GradeController@index                      | api,auth,teacher,Closure                            |
| POST   | teacher/courses/grades/several                  | Emtudo\Units\Teacher\Courses\Http\Controllers\GradeController@storeSeveral     | api,auth,teacher,Closure                                                                 |                                                     |
| PUT\| PATCH                                           | teacher/courses/grades/{grade}                                       | Emtudo\Units\Teacher\Courses\Http\Controllers\GradeController@update                     | api,auth,teacher,Closure                            |
| DELETE | teacher/courses/grades/{grade}                  | Emtudo\Units\Teacher\Courses\Http\Controllers\GradeController@destroy          | api,auth,teacher,Closure                                                                 |                                                     |
| GET\| HEAD                                            | teacher/courses/grades/{grade}                                       | Emtudo\Units\Teacher\Courses\Http\Controllers\GradeController@show                       | api,auth,teacher,Closure                            |
| GET\| HEAD                                            | teacher/courses/groups                                               | Emtudo\Units\Teacher\Courses\Http\Controllers\GroupController@index                      | api,auth,teacher,Closure                            |
| POST   | teacher/courses/groups                          | Emtudo\Units\Teacher\Courses\Http\Controllers\GroupController@store            | api,auth,teacher,Closure                                                                 |                                                     |
| GET\| HEAD                                            | teacher/courses/groups/{group}                                       | Emtudo\Units\Teacher\Courses\Http\Controllers\GroupController@show                       | api,auth,teacher,Closure                            |
| PUT\| PATCH                                           | teacher/courses/groups/{group}                                       | Emtudo\Units\Teacher\Courses\Http\Controllers\GroupController@update                     | api,auth,teacher,Closure                            |
| DELETE | teacher/courses/groups/{group}                  | Emtudo\Units\Teacher\Courses\Http\Controllers\GroupController@destroy          | api,auth,teacher,Closure                                                                 |                                                     |
| GET\| HEAD                                            | teacher/courses/quizzes                                              | Emtudo\Units\Teacher\Courses\Http\Controllers\QuizController@index                       | api,auth,teacher,Closure                            |
| POST   | teacher/courses/quizzes                         | Emtudo\Units\Teacher\Courses\Http\Controllers\QuizController@store             | api,auth,teacher,Closure                                                                 |                                                     |
| DELETE | teacher/courses/quizzes/{quiz}                  | Emtudo\Units\Teacher\Courses\Http\Controllers\QuizController@destroy           | api,auth,teacher,Closure                                                                 |                                                     |
| PUT\| PATCH                                           | teacher/courses/quizzes/{quiz}                                       | Emtudo\Units\Teacher\Courses\Http\Controllers\QuizController@update                      | api,auth,teacher,Closure                            |
| GET\| HEAD                                            | teacher/courses/quizzes/{quiz}                                       | Emtudo\Units\Teacher\Courses\Http\Controllers\QuizController@show                        | api,auth,teacher,Closure                            |
| GET\| HEAD                                            | teacher/courses/subjects                                             | Emtudo\Units\Teacher\Courses\Http\Controllers\SubjectController@index                    | api,auth,teacher,Closure                            |
| POST   | teacher/courses/subjects                        | Emtudo\Units\Teacher\Courses\Http\Controllers\SubjectController@store          | api,auth,teacher,Closure                                                                 |                                                     |
| GET\| HEAD                                            | teacher/courses/subjects/{subject}                                   | Emtudo\Units\Teacher\Courses\Http\Controllers\SubjectController@show                     | api,auth,teacher,Closure                            |
| DELETE | teacher/courses/subjects/{subject}              | Emtudo\Units\Teacher\Courses\Http\Controllers\SubjectController@destroy        | api,auth,teacher,Closure                                                                 |                                                     |
| PUT\| PATCH                                           | teacher/courses/subjects/{subject}                                   | Emtudo\Units\Teacher\Courses\Http\Controllers\SubjectController@update                   | api,auth,teacher,Closure                            |
| GET\| HEAD                                            | teacher/users/students                                               | Emtudo\Units\Teacher\Users\Http\Controllers\StudentController@index                      | api,auth,teacher,Closure                            |
| GET\| HEAD                                            | teacher/users/students/search                                        | Emtudo\Units\Teacher\Users\Http\Controllers\StudentController@index                      | api,auth,teacher,Closure                            |
| GET\| HEAD                                            | teacher/users/students/{student}                                     | Emtudo\Units\Teacher\Users\Http\Controllers\StudentController@show                       | api,auth,teacher,Closure                            |
| GET\| HEAD                                            | teacher/users/users/me                                               | Emtudo\Units\Teacher\Users\Http\Controllers\UserController@showMe                        | api,auth,teacher,Closure                            |
| PUT    | teacher/users/users/me                          | Emtudo\Units\Teacher\Users\Http\Controllers\UserController@updateMe            | api,auth,teacher,Closure                                                                 |                                                     |
| GET\| HEAD                                            | teacher/users/users/{user}/documents/{kind}                          | Emtudo\Units\Teacher\Users\Http\Controllers\UserController@getDocumetByKind              | api,auth,teacher,Closure                            |
| POST   | tenant/change                                   | Emtudo\Units\Tenant\Http\Controllers\TenantController@changeTenant             | api,auth,Closure                                                                         |                                                     |
| GET\| HEAD                                            | tenant/notifications/last                                            | Emtudo\Units\Tenant\Http\Controllers\NotificationController@last                         | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/courses/courses                                            | Emtudo\Units\Search\Courses\Http\Controllers\CourseController@index                      | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/courses/courses/search                                     | Emtudo\Units\Search\Courses\Http\Controllers\CourseController@index                      | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/courses/courses/{course}                                   | Emtudo\Units\Search\Courses\Http\Controllers\CourseController@show                       | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/courses/enrollments                                        | Emtudo\Units\Search\Courses\Http\Controllers\EnrollmentController@index                  | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/courses/enrollments/search                                 | Emtudo\Units\Search\Courses\Http\Controllers\EnrollmentController@index                  | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/courses/enrollments/{enrollment}                           | Emtudo\Units\Search\Courses\Http\Controllers\EnrollmentController@show                   | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/courses/frequencies                                        | Emtudo\Units\Search\Courses\Http\Controllers\FrequencyController@index                   | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/courses/frequencies/search                                 | Emtudo\Units\Search\Courses\Http\Controllers\FrequencyController@index                   | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/courses/frequencies/{frequency}                            | Emtudo\Units\Search\Courses\Http\Controllers\FrequencyController@show                    | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/courses/grades                                             | Emtudo\Units\Search\Courses\Http\Controllers\GradeController@index                       | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/courses/grades/search                                      | Emtudo\Units\Search\Courses\Http\Controllers\GradeController@index                       | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/courses/grades/{grade}                                     | Emtudo\Units\Search\Courses\Http\Controllers\GradeController@show                        | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/courses/groups                                             | Emtudo\Units\Search\Courses\Http\Controllers\GroupController@index                       | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/courses/groups/search                                      | Emtudo\Units\Search\Courses\Http\Controllers\GroupController@index                       | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/courses/groups/{group}                                     | Emtudo\Units\Search\Courses\Http\Controllers\GroupController@show                        | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/courses/questions                                          | Emtudo\Units\Search\Courses\Http\Controllers\QuestionController@index                    | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/courses/questions/search                                   | Emtudo\Units\Search\Courses\Http\Controllers\QuestionController@index                    | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/courses/questions/{question}                               | Emtudo\Units\Search\Courses\Http\Controllers\QuestionController@show                     | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/courses/quizzes                                            | Emtudo\Units\Search\Courses\Http\Controllers\QuizController@index                        | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/courses/quizzes/search                                     | Emtudo\Units\Search\Courses\Http\Controllers\QuizController@index                        | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/courses/quizzes/{quiz}                                     | Emtudo\Units\Search\Courses\Http\Controllers\QuizController@show                         | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/courses/schedules                                          | Emtudo\Units\Search\Courses\Http\Controllers\ScheduleController@index                    | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/courses/schedules/search                                   | Emtudo\Units\Search\Courses\Http\Controllers\ScheduleController@index                    | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/courses/schedules/{schedule}                               | Emtudo\Units\Search\Courses\Http\Controllers\ScheduleController@show                     | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/courses/skills                                             | Emtudo\Units\Search\Courses\Http\Controllers\SkillController@index                       | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/courses/skills/search                                      | Emtudo\Units\Search\Courses\Http\Controllers\SkillController@index                       | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/courses/skills/{skill}                                     | Emtudo\Units\Search\Courses\Http\Controllers\SkillController@show                        | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/courses/subjects                                           | Emtudo\Units\Search\Courses\Http\Controllers\SubjectController@index                     | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/courses/subjects/search                                    | Emtudo\Units\Search\Courses\Http\Controllers\SubjectController@index                     | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/courses/subjects/{subject}                                 | Emtudo\Units\Search\Courses\Http\Controllers\SubjectController@show                      | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/transports/routes                                          | Emtudo\Units\Search\Transports\Http\Controllers\RouteController@index                    | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/transports/routes/search                                   | Emtudo\Units\Search\Transports\Http\Controllers\RouteController@index                    | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/transports/routes/{route}                                  | Emtudo\Units\Search\Transports\Http\Controllers\RouteController@show                     | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/transports/stops                                           | Emtudo\Units\Search\Transports\Http\Controllers\StopController@index                     | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/transports/stops/search                                    | Emtudo\Units\Search\Transports\Http\Controllers\StopController@index                     | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/transports/stops/{stop}                                    | Emtudo\Units\Search\Transports\Http\Controllers\StopController@show                      | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/transports/vehicles                                        | Emtudo\Units\Search\Transports\Http\Controllers\VehicleController@index                  | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/transports/vehicles/search                                 | Emtudo\Units\Search\Transports\Http\Controllers\VehicleController@index                  | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/transports/vehicles/{vehicle}                              | Emtudo\Units\Search\Transports\Http\Controllers\VehicleController@show                   | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/users/managers                                             | Emtudo\Units\Search\Users\Http\Controllers\ManagerController@index                       | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/users/managers/search                                      | Emtudo\Units\Search\Users\Http\Controllers\ManagerController@index                       | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/users/managers/{manager}                                   | Emtudo\Units\Search\Users\Http\Controllers\ManagerController@show                        | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/users/responsibles                                         | Emtudo\Units\Search\Users\Http\Controllers\ResponsibleController@index                   | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/users/responsibles/search                                  | Emtudo\Units\Search\Users\Http\Controllers\ResponsibleController@index                   | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/users/responsibles/{responsible}                           | Emtudo\Units\Search\Users\Http\Controllers\ResponsibleController@show                    | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/users/students                                             | Emtudo\Units\Search\Users\Http\Controllers\StudentController@index                       | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/users/students/search                                      | Emtudo\Units\Search\Users\Http\Controllers\StudentController@index                       | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/users/students/{student}                                   | Emtudo\Units\Search\Users\Http\Controllers\StudentController@show                        | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/users/teachers                                             | Emtudo\Units\Search\Users\Http\Controllers\TeacherController@index                       | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/users/teachers/search                                      | Emtudo\Units\Search\Users\Http\Controllers\TeacherController@index                       | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/users/teachers/{teacher}                                   | Emtudo\Units\Search\Users\Http\Controllers\TeacherController@show                        | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/users/users                                                | Emtudo\Units\Search\Users\Http\Controllers\UserController@index                          | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/users/users/search                                         | Emtudo\Units\Search\Users\Http\Controllers\UserController@index                          | api,auth,Closure                                    |
| GET\| HEAD                                            | v1/search/users/users/{user}                                         | Emtudo\Units\Search\Users\Http\Controllers\UserController@show                           | api,auth,Closure                                    |
