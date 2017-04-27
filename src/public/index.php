<?php

require '../vendor/autoload.php';
$app = new Slim\App();

$app->get('/books', function() {
  require_once('db.php');
  $query = "SELECT * FROM library ORDER BY book_id";
  $result = $connection->query($query);

  while ($row = $result->fetch_assoc()){
    $data[] = $row;
  }
  
  echo json_encode($data);
});

$app->post('/books', function($request){
  require_once('db.php');
  $query = "INSERT INTO library (book_name,book_isbn,book_category) VALUES (?,?,?)";
  
  $stmt = $connection->prepare($query);
  $stmt->bind_param("sss",$book_name,$book_isbn,$book_category);
  
  $book_name = $request->getParsedBody()['book_name'];
  $book_isbn = $request->getParsedBody()['book_isbn'];
  $book_category = $request->getParsedBody()['book_category'];
  
  $stmt->execute();
});

$app->delete('/books/{book_id}', function($request){
 require_once('db.php');
 $get_id = $request->getAttribute('book_id');
 $query = "DELETE from library WHERE book_id = $get_id";
 $result = $connection->query($query);
});

$app->run();
