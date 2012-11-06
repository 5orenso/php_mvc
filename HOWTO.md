Naming convention
-----------------
http://perldoc.perl.org/perlstyle.html

Document style
--------------
Markdown: http://daringfireball.net/projects/markdown/
Parser for MD: http://daringfireball.net/projects/markdown/dingus


Methods
-------
public 
	scope to make that variable/function available from anywhere, other classes and instances of the object.

private
	scope when you want your variable/function to be visible in its own class only.

protected
	scope when you want to make your variable/function visible in all classes that extend current class.


Magic constants
---------------
__LINE__
	The current line number of the file.
__FILE__
    The full path and filename of the file. If used inside an include, the name of the included file is returned. Since PHP 4.0.2, __FILE__ always contains an absolute path with symlinks resolved whereas in older versions it contained relative path under some circumstances.
__DIR__
	The directory of the file. If used inside an include, the directory of the included file is returned. This is equivalent to dirname(__FILE__). This directory name does not have a trailing slash unless it is the root directory. (Added in PHP 5.3.0.)
__FUNCTION__
	The function name. (Added in PHP 4.3.0) As of PHP 5 this constant returns the function name as it was declared (case-sensitive). In PHP 4 its value is always lowercased.
__CLASS__
	The class name. (Added in PHP 4.3.0) As of PHP 5 this constant returns the class name as it was declared (case-sensitive). In PHP 4 its value is always lowercased. The class name includes the namespace it was declared in (e.g. Foo\Bar). Note that as of PHP 5.4 __CLASS__ works also in traits. When used in a trait method, __CLASS__ is the name of the class the trait is used in.
__TRAIT__
	The trait name. (Added in PHP 5.4.0) As of PHP 5.4 this constant returns the trait as it was declared (case-sensitive). The trait name includes the namespace it was declared in (e.g. Foo\Bar).
__METHOD__
	The class method name. (Added in PHP 5.0.0) The method name is returned as it was declared (case-sensitive).
__NAMESPACE__
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
|- controller
|   |- news.php
|   |- router.php
|
|- model
|   |- news.php
|   |- view.php
|
|- view
|   |- news.php
|
|- lib
|   |- driver
|   |   |- mysqlimproved.php
|   |
|   |- database.php
|
|- test
|   |- user_test.php
|
|- index.php





