<?  date_default_timezone_set('Asia/Omsk');
  function printFolder($level = -1)
  {
    //Путь директории. Если хотите весь диск то просто
    $dir      = getcwd();
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir,RecursiveDirectoryIterator::KEY_AS_PATHNAME),
        RecursiveIteratorIterator::SELF_FIRST);
    $iterator->setFlags(RecursiveDirectoryIterator::SKIP_DOTS);
    //Установка максимальной глубины вложенности
    if ($level > 0) {
        $iterator->setMaxDepth($level);
    }
    //Перемотать итератор на первый элемент
    $iterator->rewind();
    foreach ($iterator as $path) {
      if ($path->isDir()) {
        //Вывод каталогов
        echo "<li><div class='collapsible-header waves-effect waves-light'><i class='material-icons'>folder</i>" .$path->getBaseName(). "</div>";
      }else{
        //Вывод файлов из каталогов
          echo "<div class='collapsible-body grey darken-4'><i class='material-icons'>attachment</i><span>".$path->getFilename()."</span></div>";
        }
      }
      echo "</li>";
    }
  //===========================================================================
  if(isset($_POST['submit_create'])){
    $folder = $_POST['new_folder'];
    $result = mkdir($folder);
  }
  if(isset($_POST['submit_remove'])){
    $folder = $_POST['remove_folder'];
    $result = rmdir($folder);
  }
  if(isset($_POST['submit_rename'])){
    if(!file_exists($_POST['r_new_folder'])){
      rename($_POST['rename_folder'], $_POST['r_new_folder']);
      echo '<script type="text/javascript">alert("Папка успешно изменена");</script>';
    }
    else {
      echo '<script type="text/javascript">alert("Ошибка");</script>';
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <!--Import main.css-->
    <link type="text/css" rel="stylesheet" href="css/main.css" />

  </head>
  <body>
    <header>
      <!--Верхняя панель-->
      <nav>
        <div class="nav-wrapper orange darken-4" role="navigation">
          <a data-activates="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        </div>
      </nav>
      <!--Боковая панель-->
      <ul id="slide-out" class="side-nav grey darken-4">
        <br />
        <div style="text-align:center;" id="logoimg">
          <img src="./icon/logo.png" alt="" class="circle responsive-img" width="200"> <br />
          Катализатор по файлам
        </div>
        <br /> <br />
        <!-- Создать директорию -->
        <a class="waves-effect waves-light btn orange darken-4 modal-trigger" href="#modal1"><i class="material-icons">create_new_folder</i></a>
        <!-- Удалить директорию -->
        <a class="waves-effect waves-light btn orange darken-4 modal-trigger" href="#modal2"><i class="material-icons">delete</i></a>
        <!-- Редактировать директорию -->
        <a class="waves-effect waves-light btn orange darken-4 modal-trigger" href="#modal3"><i class="material-icons">edit</i></a>
        <ul class="collapsible" data-collapsible="expandable">
            <? printFolder(); ?>
        </ul>
      </ul>
    </header>
    <!-- Вывод всех файлов из главной директории-->
    <main>
      <div class="section">
        <div class="container">
          <div class="row">
              <? include_once 'dd.php'; ?>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!-- Модальный диалог создание папки-->
    <div id="modal1" class="modal">
      <div class="modal-content">
        <h4>Введите название каталога</h4>
        <div class="row">
          <form class="col s10" method="post" action="<? $_SERVER["PHP_SELF"]; ?>">
            <div class="row modal-form-row">
              <div class="input-field col s10">
                <input id="new_folder" name="new_folder" type="text" class="validate" />
                <label for="new_folder">Введите название папки, которую хотите создать</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input type="submit" id="submit_create" name="submit_create" class="waves-effect waves-light btn" value="Создать"/>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <a href="" class=" modal-action modal-close waves-effect waves-orange btn-flat">Закрыть</a>
      </div>
    </div>
    <!-- Модальный диалог удаление папки-->
    <div id="modal2" class="modal">
      <div class="modal-content">
        <h4>Введите название каталога</h4>
        <div class="row">
          <form class="col s10" method="post" action="<? $_SERVER["PHP_SELF"]; ?>">
            <div class="row modal-form-row">
              <div class="input-field col s10">
                <input id="remove_folder" name="remove_folder" type="text" class="validate" />
                <label for="remove_folder">Введите название папки, которую хотите удалить</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input type="submit" id="submit_remove" name="submit_remove" class="waves-effect waves-light btn" value="Удалить"/>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <a href="" class=" modal-action modal-close waves-effect waves-orange btn-flat">Закрыть</a>
      </div>
    </div>
    <!-- Модальный диалог изменение папки-->
    <div id="modal3" class="modal">
      <div class="modal-content">
        <h4>Введите название каталога</h4>
        <div class="row">
          <form class="col s10" method="post" action="<? $_SERVER["PHP_SELF"]; ?>">
            <div class="row modal-form-row">
              <div class="input-field col s10">
                <input id="rename_folder" name="rename_folder" type="text" class="validate" value="<? echo getcwd();?>\"/>
                <label for="rename_folder">Введите название папки, которую хотите изменить</label>
              </div>
            </div>
            <div class="row modal-form-row">
              <div class="input-field col s10">
                <input id="r_new_folder" name="r_new_folder" type="text" class="validate" value="\"/>
                <label for="r_new_folder">Введите новое название папки</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input type="submit" id="submit_rename" name="submit_rename" class="waves-effect waves-light btn" value="Изменить"/>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <a href="" class=" modal-action modal-close waves-effect waves-orange btn-flat">Закрыть</a>
      </div>
    </div>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
      Materialize.fadeInImage('#logoimg');
      Materialize.showStaggeredList('#slide-out');
      $(".sidenav-trigger").sideNav();
      $('.modal').modal();
      $('.modal2').modal();
      $('.modal3').modal();
    });
    </script>
  </body>
</html>
