###### LARAVEL #####

1. Run PHP Artisan Commands On Shared Hosting Servers
====================================================
Route::get('/config-clear', function() {
    Artisan::call('config:clear');
    // Do whatever you want either a print a message or exit
});


2. Specified Key Was Too Long Error In Laravel
================================================
Solution 1:
Go to app/Providers directory and open AppServiceProvider.php file and adjust the boot() method to the following.
	public function boot()
	{
	    Schema::defaultStringLength(191);
	}

Solution 2:
Go to config directory and open database.php file.
In that file, you can see two attributes 'charset' => 'utf8mb4'and 'collation' => 'utf8mb4_unicode_ci'in mysql driver.
'charset' => 'utf8',
'collation' => 'utf8_unicode_ci',

3. How To Add Laravel Next Prev Pagination
===========================================
Method 1:
	$posts = Post::simplePaginate(10);
	return view('posts.index', compact('posts'));
	<div class="paginationWrapper">
	    {{ $posts->links() }}
	 </div>

Method 2:
	@if(isset($posts))
	   @if($posts->currentPage() > 1)
	      <a href="{{ $posts->previousPageUrl() }}">Previous</a>
	   @endif
	 
	   @if($posts->hasMorePages())
	      <a href="{{ $posts->nextPageUrl() }}">Next</a>
	   @endif
	@endif
Method 3:
	$post = Post::find($id);
    $previous = Post::select('slug')->where('id', '<', $post->id)->orderBy('id', 'desc')->first();
    $next = Post::select('slug')->where('id', '>', $post->id)->first();
	return view('post.single', ['post' => $post,'next' => $next, 'prev' => $previous]);

	@if(!empty($posts))
     <div class="paginationWrapper">
        <a href="{{ url() }}/blog/{{ $prev->slug }}">Previous</a>
        <a href="{{ url() }}/blog/{{ $next->slug }}">Next</a>
     </div>
     @endif

4. How To Calculate Age From Birthdate
========================================
Method 1. Using Functions in PHP
	$birthDate = '1995-05-25';
	$currentYear = date('Y');
	$birthYear = date('Y', strtotime($birthDate));
	$age = $currentYear - $birthYear;
	echo $age;

Method 2. Using Carbon In Laravel
	use Carbon\Carbon
	$birthDate = '1992-05-25';
	$age = Carbon::parse($birthDate)->age;

Method 3. Using Functions In MySQL
	SELECT TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) AS age FROM `users`;

5. Difference Between Factory And Seeders In Laravel
====================================================
Seeder:
	1. Go to CLI and run an Artisan command php artisan make:seeder UsersSeeder
	2. UserSeeder class has been created into database/seeds directory
	3. Now open the database/seeds/UsersSeeder.php file and adjust the run method to the following.
	public function run()
    {
        DB::table('users')->insert(
            [
                'name' => Str::random(10),
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('password'),
            ],
        );
    }
    4. Now open the database/seeds/DatabaseSeeder.php file and adjust the run method to the following.
    public function run()
    {
        $this->call(UsersSeeder::class);
    }
    5. Then go to the CLI and run an Artisan command php artisan db:seed.

	When Should I Use Seeders?
	==============================
	It is not meant that seeders are not useful. We have found lots of cases where seeders are very very useful as following.
	1. When you have a predefined dataset like a large number of Questionnaires, Surveys, etc.
	2. To create default users like Administrator.
	3. Dictionaries, Medicines data, Tutorials, etc.

FACTORY:
	1. Go to CLI and run an Artisan command php artisan make:factory PostFactory
	2. PostFactory file has been created into database/factories directory
	3. Now open the database/seeds/PostFactory.php file and adjust as the following.
	$factory->define(Post::class, function (Faker $faker) {
	    return [
	        'title' => $faker->sentence(5),
	        'description' => $faker->text(),
	        'user_id' => factory('App\User')->create()->id,
	    ];
	});
	4. Now open the database/seeds/DatabaseSeeder.php file and adjust the run method to the following.
	public function run()
    {
        factory(User::class, 2)->create();
        factory(Post::class, 2)->create();
    }
    5.  Then go to the CLI and run an Artisan command php artisan db:seed.

 Different b/w seeder and factory
 ===============================
	It uses a Faker class to generate dummy data. Factory can also generate relationship data with the Model which seeder can’t do.

6. Session not Working in Laravel
=========================================
    1. Go to “App/Http” and open Kernel.php file
    2. Add this line \Illuminate\Session\Middleware\StartSession::class, into the $middleware array. Please check the below screenshot.
To Store An Array
	Session::push('key', $array);
	//or
	session()->push('key', $array);
Retrieving Session By Key
	Session::get('key');
	//or
	session('key');
	//or
	Session::all();

7. Why CSRF(cross-site request forgery) Token Mismatch Error Occurs
=======================================================================
	1. Exclude URIs From CSRF Protection
	=====================================
	Sometimes you may wish to exclude the URLs from the CSRF protection. For example, if you are using any 3rd party services and in that you might need to submit a form from your website in that case, you don’t need to use CSRF token.

	1. Go to the app/Http/Middleware directory and open the VerifyCsrfToken.php file.
    2. Now, in protected $except array, add your URIs like below and you are done.
    	protected $except = [
	        'stripe/*',
	        'http://example.com/foo/bar',
	        'http://example.com/foo/*',
	    ];

	2. Change CSRF Token Mismatch Error Message In Laravel
	========================================================
	1. First, go to the app/Exceptions directory and open the Handler.php file.
    2. In render() method add the following code.
    if ($request->expectsJson()) {
	    if ($exception instanceof TokenMismatchException) {
	        return response()->json([
	        'message' => 'Your session has expired. You will need to refresh the page and login again to continue using the system.'], 419);
	    }
	}

8. Simple Difference Between Events and Observers
================================================
Observers are basically predefined events that happen only on Eloquent Models (creating a record, updating a record, deleting, etc). Events are generic, aren’t predefined, and can be used anywhere, not just in models.
	## Why Observers Used in Laravel?
	==================================
	An observer watches for specific things that happen within eloquent such as saving, saved, deleting, deleted (there are more but you should get the point). Observers specifically bound to a model.

	## Why Events Used in Laravel?
	==============================
	Events are actions that are driven by whatever the programmer wants. If you want to fire an event when somebody loads a page, you can do that. Events can also be a queue and ran via Laravel’s cron job.

	The programmer can define Events effectively. Events give you the ability to handle actions that you would not want a user to wait for (an example being the purchase of podcasts).

9. Example: Using Query Scopes
==================================
The Query Scopes is standard way of declaring additional conditions. It is very helpful to build more readable & reusable code.
You can define the scopes in your model by creating scopeFunctioname. That means you need to prefix scope word with the function name. For example, you want to create a status method then your scope will be scopeStatus. Let’s see the example

public function scopeLikes($query)
{
    return $query->where('likes', '>', 100);
}
public function scopeStatus($query)
{
    return $query->where('status', 'publish');
}

After defining scope you can then use it as below:
$posts = Post::status()->likes()->get();


10. Laravel One To One Relationship
========================================
In a very simpler word, If one table’s one record is associated with another table’s one record then it’s called the One To One relationship. 

	## Example Of One To One Relationship
	========================================

	1. The hasOne() method is used to define the 1 to 1 relationship and on another model, we will use the belongsTo() method to define the inverse relationship.
	2. So if User model has associated with a Passport model then a passport() method needs to add in User model with hasOne() method. Let’s see how to do it.

	**1. Create Migrations
	------------------------
	let’s open the passports table’s migration file and let’s connect it with users table by defining user id and foreign key.
	Schema::create('passports', function (Blueprint $table) {
	    $table->id();
	    $table->integer('user_id')->unsigned();
	    $table->string('passport_number')->unique();
	    $table->timestamps();
	 
	    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
	});

	**2. Create Models
	------------------------
	In app/Models/User.php
		public function passport()
	    {
	        return $this->hasOne(Passport::class);
	    }
	In app/Models/Passport.php
		public function user()
	    {
	        return $this->belongsTo(User::class);
	    }

	 **3. Read Records
	 ----------------------
	 App\Models\User::find(41)->passport
	 	id: 1,
	 	user_id: 41,
	 	passport_number: "testnumber",
	 	created_at: "20201-01-12 20:24:21",
	 	updated_at: "20201-01-12 20:24:21",

	 App\Models\Passport::find(1)->user
	 	id: 41,
	 	name: "neeraj",
	 	email: "testnumber@gmail.com",
	 	created_at: "20201-01-12 20:24:21",
	 	updated_at: "20201-01-12 20:24:21",

	**4. Create Records
	---------------------
		$user = User::find(1);
		$passport = new Passport;
		$passport->passport_number = 'AB124HERKHKBSD78646DFJ';
		$user->passport()->save($passport);

		$passport = Passport::find(1);
		$user = User::find(10);
		$passport->user()->associate($user)->save();


11. Laravel One To Many Relationship
========================================
	**1. Understanding Laravel One To Many Relationship
	---------------------------------------------------
	The one to many is useful where one model’s single record is associated with another model’s multiple records.
	Example:- A very simple example of one to many is, A single Post or Article has many comments.

	**2. Create Models and Migrations
	----------------------------------
	In one to many, we need to create two models Post & Comment with two migrations files.

	**3. Migrations
	-----------------
		Post Migration
			Schema::create('posts', function (Blueprint $table) {
	            $table->id();
	            $table->string('title');
	            $table->text('description');
	            $table->timestamps();
	        });

	    Comment Migration
	    	Schema::create('comments', function (Blueprint $table) {
	            $table->id();
	            $table->integer('post_id')->unsigned();
	            $table->string("comment");
	            $table->timestamps();
	 
	            /*@ Connect comment table's post_id with post table's id field */
	            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
	        });

	**4. Add One To Many Relationship In Models
	---------------------------------------------
	In app/Models/Post.php
		public function comments()
	    {
	        return $this->hasMany(Comment::class);
	    }

	In app/Models/Comment.php
		public function post()
	    {
	        return $this->belongsTo(Post::class);
	    }

	**5. Read Data
	----------------
	App\Models\Post::find(12)->comments
		id: 2,
	 	post_id: 12,
	 	comment: "testnumber",
	 	created_at: "20201-01-12 20:24:21",
	 	updated_at: "20201-01-12 20:24:21",		

	App\Models\Comment::find(1)->post
		id: 11,
	 	title: "abcde",
	 	description: "testnumber",
	 	created_at: "20201-01-12 20:24:21",
	 	updated_at: "20201-01-12 20:24:21",				

	**6 Create Records
	-------------------
		$post = Post::find(1);
		$comment = new Comment();
		$comment->comment = 'I love this blog post. Keep it up.';
		$post->comments()->save($comment);

		$post = Post::find(1);
		$post->comments()->saveMany([
		    new Comment(['comment' => 'A new comment.']),
		    new Comment(['comment' => 'Another new comment.']),
		]);

	**7 Update Records
	--------------------
		$comment = Comment::find(1);
		$comment->comment = 'I am updating';
		$comment->save();

	**8. Delete Records
	----------------------
		$post = Post::find(1);
		$post->comments()->delete();

12. How To Convert Word To PDF In Laravel
=========================================
Refer the url: https://www.scratchcode.io/how-to-convert-word-to-pdf-in-laravel/
https://www.scratchcode.io/laravel-datatables-tutorial-with-example/

13. Design pattern in laravel
=============================
	Repository pattern is a very helpful & commonly used design pattern where data access logic is stored. It hides the details of data access logic from business logic and keep the code cleaner and more readable. This is not mandatory to use it but we should use.

	There are four type of designing pattern available
		1. Builder (Manager) pattern
		2. Factory pattern
		3. Repository pattern
		4. Strategy pattern

		

14. What is service provider
=============================
	Service providers are the central place of all Laravel application bootstrapping. Your own application, as well as all of Laravel's core services are bootstrapped via service providers.

	But, what do we mean by "bootstrapped"? In general, we mean registering things, including registering service container bindings, event listeners, middleware, and even routes. Service providers are the central place to configure your application.

15. What is events in laravel.
==============================
	In Laravel, events can be various actions that occur within an application such as email notifications, logging, user sign up, CRUD operations etc. Laravel events provide a simple observer implementation, allowing you to subscribe and listen for various events that occur in your application.

	1. Make an event
		php artisan make:event imageDetails
		file will created on App\Events folder
	2. Make a Listener
		php artisan make:listener Details
		file will created on App\Listeners folder

	On controller files where you want to add event
		public function showUploadFile(Request $request) {
	        $file = $request->file('image');
	        event(new \App\Events\imageDetails($file));
    	 }

    On App\Events\imageDetails file
    	public $file;
    	public function __construct($file)
	    {
	        $this->file = $file;
	    }

	On App\Listener\Details file
		public function handle($event)
	    {
	        dump('Image uploaded successfully');
	    }

	On App\Providers\EventServiceProvider file
		protected $listen = [
	        imageDetails::class => [
	            \App\Listeners\Details::class,
	            \App\Listeners\uploadeImage::class,
	        ],
	    ];

16. Function in the blade and any specific method?
====================================================
	{{ ControllerName::Functionname($params); }}
	OR
	<?php echo ControllerName::Functionname($params);?>







##### LARAVEL END #####


##### PHP MYSQL #####

1 . Check Duplicate Records Exists In Database
===============================================
	SELECT
	`column_name`, COUNT(column_name) AS NumOccurrences
	FROM `table_name` 
	GROUP BY `column_name` 
	HAVING (COUNT(column_name) > 1)

2. Select Records Between Two Years
======================================
SELECT * FROM `order` WHERE YEAR(order_date) BETWEEN '2019' AND '2020'

3. Select Records Between Two Months
====================================
SELECT * FROM `order` WHERE MONTH(order_date) BETWEEN '05' AND '06'

4. Select All Records Between Two Months of Specific Year
=========================================================
SELECT * FROM `order` WHERE MONTH(order_date) BETWEEN '05' AND '06' AND YEAR(order_date) = '2020'

5. Select All Records of Specific Month
=========================================
SELECT * FROM `order` WHERE MONTH(order_date) = '05'

6. Select All Records of Current Month
=======================================
SELECT * FROM `order` WHERE MONTH(order_date) = MONTH(CURDATE())

7. Select All Records of Specific Month & Specific Year
SELECT * FROM `order` WHERE MONTH(order_date) = '05' AND YEAR(order_date) = '2020'

8. Relational or Non-Relational Database.
==========================================
	1. A relational database is structured, meaning the data is organized in tables. Many times, the data within these tables have relationships with one another, or dependencies. A non relational database is document-oriented, meaning, all information gets stored in more of a laundry list order.






###### PHP ######
==============

1. cache =>
====================
	1. php artisan config:clear is used to remove the configuration cache file. Then you can again run php artisan config:cache command to recreate the configuration cache file.
	2. php artisan config:cache stores cached files in bootstrap/cache/config.php. So you get rename or remove that file. Now, go and test your application. It should be resolved.
	
	$expiresAt = Carbon::now()->addMinutes(10);
	Cache::put('key', 'value', $expiresAt);

	Checking For Existence In Cache
	--------------------------------
	if (Cache::has('key'))
	{
	    $value = Cache::get('key');
	}


2. Traits vs. interfaces
========================
	The main difference is that, with interfaces, you must define the actual implementation of each method within each class that implements said interface, so you can have many classes implement the same interface but with different behavior, while traits are just chunks of code injected in a class; another important	difference is that trait methods can only be class-methods or static-methods, unlike interface methods which can also (and usually are) be instance methods.

3. What is store procedure
=========================
	Stored procedures help reduce the network traffic between applications and MySQL Server. Because instead of sending multiple lengthy SQL statements, applications have to send only the name and parameters of stored procedures.

4. What is trigger
=====================
	Trigger: A trigger is a stored procedure in database which automatically invokes whenever a special event in the database occurs. For example, a trigger can be invoked when a row is inserted into a specified table or when certain table columns are being updated.

5. Callback Functions
=====================
	A callback function (often referred to as just "callback") is a function which is passed as an argument into another function.
	Any existing function can be used as a callback function. To use a function as a callback function, pass a string containing the name of the function as the argument of another function:
	Examplie:
	 <?php
		function my_callback($item) {
		  return strlen($item);
		}

		$strings = ["apple", "orange", "banana", "coconut"];
		$lengths = array_map("my_callback", $strings);
		print_r($lengths);
	?> 

6. Anonymous functions
=========================
	Anonymous function is a function without any user defined name. Such a function is also called closure or lambda function. Sometimes, you may want a function for one time use. Closure is an anonymous function which closes over the environment in which it is defined. You need to specify use keyword in it.Most common use of anonymous function to create an inline callback function.
	<?php
		$var = function ($x) {return pow($x,3);};
		echo "cube of 3 = " . $var(3);
	?>

7. Compact function in php
===============================
Create an array from variables and their values:
 <?php
	$firstname = "Peter";
	$lastname = "Griffin";
	$age = "41";

	$result = compact("firstname", "lastname", "age");

	print_r($result);
?> 

output:- Array ( [firstname] => Peter [lastname] => Griffin [age] => 41 ) 


8. Difference between session and cookies.
===========================================
	1. The main difference between a session and a cookie is that session data is stored on the server, whereas cookies store data in the visitor’s browser. 
	2. Data stored in cookie can be stored for months or years, depending on the life span of the cookie. But the data in the session is lost when the web browser is closed.

	setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day,60 = 1 sec,60*60 = 1 hours

9. Difference betweeb echo and print.
======================================
	1. They are both used to output data to the screen. The differences are small: 
		echo has no return value while print has a return value of 1 so it can be used in expressions. 
		echo can take multiple parameters (although such usage is rare) while print can take one argument.
		echo is faster then print.












###### JS ######
======================

1. difference between w onload and document.ready in jquery
=============================================================
    1. Body.Onload() event will be called only after the DOM and associated resources like images got loaded, but jQuery's document.ready() event will be called once the DOM is loaded i.e., it wont wait for the resources like images to get loaded. Hence, the functions in jQuery's ready event will get executed once the HTML structure is loaded without waiting for the resources.
    2. We can have multiple document.ready() in a page but Body.Onload() event cannot.

















innoDB == Default engin for < version 5.5, transaction, foren key,
MYISAM == fast compare to innoDB. has no transaction
barkley == banking sector use this engin.



clustered indexes
primary keys
transactional

wobot int

get == retrive the data
post = creating data on server
put == update data on server
delet == deleting data on server

auth tech
================
session/cookies
basic auth  // username/password <!-- [PHP_AUTH_USER] => APPAVANZAAPI [PHP_AUTH_PW] => AY53u$?dB=X49T+m -->
digest auth
api key // [HTTP_ALLOWED_USERS] OR getallheaders(); $headers["Allowed-Users"];
oAuth

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");

$response     = array();
$request_data = json_decode(file_get_contents('php://input'), true);
$action       = isset($request_data['action']) ? $request_data['action'] : '';




1- What is the Version of Laravel?
2- What are the Features of Laravel?
4- Job Queue and Approach to schedule?
5- Artisan command in Laravel?
6- What are Threads?
7- Function in the blade and any specific method?
8- Inject in blade & Dependency injection?
9- Middleware with Practical Example?
10- What is Passports?
11- Methods in API?
12- Difference bw Put & Post?
13- Can we use the Put method in the blade?
14- What is cashing in Laravel?
15- Difference bw Primary & unique key?
16- Can the database have more than one key?
17- Difference bw candidate & Super Key?
18- Gates in LARAVEL?
19- Maat website Laravel excel package?
20- How to import excel in DB?
21- GIT, How branches work?
22- What is Crown Job?
23- Eloquent Model?
24- Helper methods in Laravel?
25- current project u done in laravel?
26- why u choose laravel as framework?
polling and webhook ?
reposateory pattern ?
DTO ?
Swagger ?
LINT?

echo and print differenct 
session and cookies ?
Encapsulation 
static keyword
Relational or Non-Relational Database
JOINS in mysql
fetch and git pull
gitstrash
polymorphism
final keyword
Life cycle of React Js
Access Modifier
