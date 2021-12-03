<form name="comment" action="comment.php" method="POST">
  <p>
    <label>Ваш комментарий:</label>
    <br />
    <textarea name="text_comment" cols="30" rows="5"></textarea>
  </p>
  <p>
    <input type="hidden" name="foto_id" value="<?php echo $showArrFoto[$counter] ?>" />
    <input type="submit" name="send" value="Отправить комментарий" style="background-color: yellowgreen;border-radius: 10px"/>
  </p>
  
</form>