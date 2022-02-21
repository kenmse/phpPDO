<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'pdo';

//SET the DSN
$dsn = 'mysql:host='.$host.';dbname='.$dbname;

// Create  a PDO instance
$pdo = new PDO($dsn, $user, $password);

//IF you wanna set the default fetch attribute to say objects, you can use the following flag
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
//This can be overridden by by declaration in line

// PDO Query searching the table called pdotable
//$stmt = $pdo->query('SELECT * FROM pdotable');
//echo '<table border=1>
//		<tr><td><span  valign="center"><b>Title</b></span></td></tr>';

//while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
//	echo '<tr><td>'.$row['title'].'</td></tr>';
//}
//
// ^ This here fetches the row by assocuation


//while($row = $stmt->fetch(PDO::FETCH_OBJ)){
//	echo '<tr><td>'.$row->title.'*</td></tr>';
//}
//echo '</table>';

## PREPARED STATEMENTS (prepate and execute)
# Unsafe way

//$sql="SELECT * FROM pdotable WHERE author =;

//FETCH MULUTIPLE POSTS

//Positional Params
//$author ="Witch Witchington";
//$sql = 'SELECT * FROM pdotable WHERE author = ?';

//$stmt = $pdo->prepare($sql);

//$stmt->execute([$author]);

//$posts = $stmt->fetchAll();

//var_dump($posts);

// Named Parameters

$author ="Joff";
$is_published = "1";
$id = 6;

//This is the query
$sql = 'SELECT * FROM pdotable WHERE author = :author && is_published = :is_published';

//Prepare the statement
$stmt = $pdo->prepare($sql);

//Execure the statement
$stmt->execute(['author' => $author, 'is_published' => $is_published]);
//FetchAll to get all the data
$posts = $stmt->fetchAll();

foreach($posts as $post){
	echo '<h1>'.$post->title.'</h1>'.$post->created_at.'<br />'.$post->body.'<br /><hr />';
}

//Let's fetch a single post
//This is the query
$sql = 'SELECT * FROM pdotable WHERE id = :id';

//Prepare the statement
$stmt = $pdo->prepare($sql);

//Execure the statement
$stmt->execute(['id' => $id]);

//Fetch to get all single data
//FetchAll is to get multiple results

$post = $stmt->fetch();

//This is to obtain the rowcount of the returned data.

$postCount = $stmt->rowCount();

//Echo out the Post
echo $post->body;
echo $postCount;

//Inserting Data

//Creting variables
$title = "Ffeesss ";
$body = "Ffeesss Ffeesss Ffeesss Ffeesss Ffeesss Ffeesss Ffeesss Ffeesss Ffeesss Ffeesss Ffeesss Ffeesss Ffeesss Ffeesss Ffeesss Ffeesss Ffeesss ";
$author = "Kevinze";
$is_published=1;

//Create the sql

$sql='INSERT INTO pdotable(title, body, author, is_published) VALUES(:title, :body, :author, :is_published)';

$stmt = $pdo->prepare($sql);

//$stmt->execute(['title'=>$title,'body' => $body,'author' => $author, 'is_published'=>$is_published]);


//Update 

$title = "GTi 55";
$body = "This is my body GTi 5";
$id= 11;


$sql = 'UPDATE pdotable SET title=:title,body=:body WHERE id=:id';

$stmt = $pdo->prepare($sql);

$stmt->execute(['title'=>$title,'body'=>$body, 'id'=>$id]);

echo 'Updated';

//Performing a PDP delete using named parameters

//initializing the primary key of the row to be deleted.

$id=1
	
//Delete SQL	
$sqldelete = 'DELETE FROM pdotable WHERE id=:id';

//Prepare the PDO statement
$stmt = $pdo->prepare($sqldelete);

//Execute the prepared statement
$stmt->execute(['id'=>$id]);

// Echo that the delete is successful
echo 'Delete successful';

	
