What is this?
=============
This is a simple PHP MVC framework made by me trying to learn the gory details of a
Model View Controller concept in PHP.

Who?
====
I'm a Perl ninja wanting to learn more about PHP. 

Why?
====
I have been working with Perl for 15 years and now is the time to learn something new.

Please feel free to contribute to this project.


Template engine 
---------------
After reading all I've found about template engines, I landed on Twig this time. It's simple, smart and easy to learn.

[Twig tutorial](http://www.sebastien-giroux.com/2010/10/twig-tutorial/)


Naming convention
-----------------
Of course [perlstyle programming](http://perldoc.perl.org/perlstyle.html) is my choice. What did you expect ;)


Document style
--------------
[Markdown](http://daringfireball.net/projects/markdown/)

[Parser for Markdown](http://daringfireball.net/projects/markdown/dingus)


PHP Methods class/function/var types
------------------------------------
#### public 
Scope to make that variable/function available from anywhere, other classes and instances of the object.

#### private
Scope when you want your variable/function to be visible in its own class only.

#### protected
Scope when you want to make your variable/function visible in all classes that extend current class.

#### abstract
TODO

#### static
TODO

PHP Magic constants 
-------------------
I'm new to PHP and need to understand it all by documenting all important aspects.

#### \_\_LINE__
The current line number of the file.

#### \_\_FILE__
The full path and filename of the file. If used inside an include, the name of the included file is returned. Since PHP 4.0.2, __FILE__ always contains an absolute path with symlinks resolved whereas in older versions it contained relative path under some circumstances.

#### \_\_DIR__
The directory of the file. If used inside an include, the directory of the included file is returned. This is equivalent to dirname(__FILE__). This directory name does not have a trailing slash unless it is the root directory. (Added in PHP 5.3.0.)

#### \_\_FUNCTION__
The function name. (Added in PHP 4.3.0) As of PHP 5 this constant returns the function name as it was declared (case-sensitive). In PHP 4 its value is always lowercased.

#### \_\_CLASS__
The class name. (Added in PHP 4.3.0) As of PHP 5 this constant returns the class name as it was declared (case-sensitive). In PHP 4 its value is always lowercased. The class name includes the namespace it was declared in (e.g. Foo\Bar). Note that as of PHP 5.4 __CLASS__ works also in traits. When used in a trait method, __CLASS__ is the name of the class the trait is used in.

#### \_\_TRAIT__
The trait name. (Added in PHP 5.4.0) As of PHP 5.4 this constant returns the trait as it was declared (case-sensitive). The trait name includes the namespace it was declared in (e.g. Foo\Bar).

#### \_\_METHOD__
The class method name. (Added in PHP 5.0.0) The method name is returned as it was declared (case-sensitive).

#### \_\_NAMESPACE__
The name of the current namespace (case-sensitive). This constant is defined in compile-time (Added in PHP 5.3.0).


MVC - Model View Controller
---------------------------

	+--------+                    +------------+                         +-------+
	| Client |  --- http req -->  | Controller |  --- req data obj --->  | Model |
	|        |  <-- http res ---  |            |  --- return --------->  |       |
	+--------+                    +------------+                         +-------+
									   ^  |
									   |  |
			   Send formatted response |  | send model data obj
									   |  v
								  +------------+
								  |    View    |
								  |            |
								  +------------+
	File structure
	--------------
	|- cli                        (command line stuff)
	|
	|- config                     (config files)
	|   |- main.ini
	|
	|- controller
	|   |- news.php               (news controller)
	|   |- router.php             (main app router)
	|
	|- db                         (database sql files)
	|
	|- lib                        (general libraries)
	|   |- driver                 (general database drivers)
	|   |   |- mongodb.php
	|   |   |- mysqlimproved.php
	|   |   |- posgresql.php
	|   |- database.php           (schema for a database driver)
	|   |- tools.php              (general tools for web apps)
	|
	|- model
	|   |- news.php               (news model)
	|   |- view.php               (view model to load Twig and emit html)
	|
	|- view
	|   |- news.html              (news html with Twig tags.)
	|
	|- test                       (unit tests)
	|   |- user_test.php
	|
	|- env.php                    (just an env dumper)
	|- index.php                  (file to fire up app)
	|- README.md                  (this file)


Packages are found here:
------------------------
[Composer packages](https://packagist.org/)

Pear:
apt-get


Databases
=========

MySQL
-----
TODO: Add some install instructions and SQL for creating table.

PostgreSQL
----------
PHP Driver: sudo apt-get install php5-pgsql
TODO: Add some install instructions and SQL for creating table.

### PgBouncer
Connection pooling is done with [PgBouncer](http://wiki.postgresql.org/wiki/PgBouncer#Documentation)

MongoDB
-------
TODO: Add some install instructions and SQL for creating table.


Authors
-------
**Øistein Sørensen**

+ http://litt.no/twitter
+ http://litt.no/linkedin


Copyright and license
---------------------

Copyright 2012 sorenso@gmail.com

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this work except in compliance with the License.
You may obtain a copy of the License in the LICENSE file, or at:

   http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.




