<?php
/*!
 * outPutJsonBookData v1.0 (https://github.com/hanzhq-spec/outputjson)
 * Copyright hanzhq-spec
 * Licensed under MIT
 *
 * Purpose
 * 输出指定格式BookData.json文件到当前目录，并提供下载。
 * 
/*!*/
function strsToArray($bookName,$bookId) { 
  $bookCover = '/Public/editor/attached/image/20210326/';
  $bookUrl = '/Public/editor/attached/file/20210326/';
  $bnArrResult = $bnArr =$biArr = $jsonArr = [];
  $bookName = str_replace("\r\n", "\n", trim($bookName));
  $bnArr = explode("\n", $bookName);
  $bookId = str_replace("\r\n", "\n", trim($bookId));
  $biArr = explode("\n", $bookId);
  foreach ($bnArr as $key => $value) {
    if ('' != ($value = trim($value))) {
      $bnArrResult[$key][0] = $value;
    }
  }
  foreach ($biArr as $key => $value) {
    if ('' != ($value = trim($value))) {
      $bnArrResult[$key][1] = $value;
    }
  }
  foreach ($bnArrResult as $value){
    array_push($jsonArr,[
      "BookId"=>null,
      "bookTitle"=>"$value[0]",
      "Author"=>"0",
      "Publish"=>"0",
      "ClassId"=>"0",
      "ClassName"=>"0",
      "Edition"=>null,
      "Cover"=>$bookCover.$value[1].'.jpg',
      "BookUrl"=>$bookUrl.$value[1].'.pdf',
      "CreateDate"=>null,
      "BookExtension"=>null,
      "ParentId"=>null,
      "Childs"=>null,
      "ISBN"=>"978-7-5139-2943-1",
      "BookSize"=>null
      ]);    
  }
    // 转PHP关联数组为JSON,未转义Unicode与/
    $json_string = json_encode($jsonArr,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    // 写入文件
    file_put_contents('BookData.json', $json_string);
}
$display = 'style="display:none;"';
if(isset($_POST["bookName"])&&$_POST["bookId"]){
  $bookName = $_POST["bookName"];
  $bookId = $_POST["bookId"];
  strsToArray($bookName,$bookId);
  $display = 'style="display:inblock;margin-left:30px;"';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>输出Json文件工具</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="form-signin">
  <h2>输出Json文件工具 - ver1.1</h2>  
  <form action="" method="post">
  <textarea placeholder="一行一本书" required name="bookName"   cols="40"   rows="24"></textarea>
  <textarea placeholder="对应每行书的Cover" required name="bookId"   cols="40"   rows="24"></textarea>
  <br>
  <input style="width:40%" type="submit" value="生成JSON"> <span <?php echo $display ?>><a href="BookData.json" download="w3logo">点击下载</a></span>
  </form>  
</div>

</body>
</html>