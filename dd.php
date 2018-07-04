
<?php
	if($_SERVER['QUERY_STRING']=="hidden")
	{$hide="";
	 $ahref="./";
	 $atext="Hide";}
	else
	{$hide=".";
	 $ahref="./?hidden";
	 $atext="Show";}

	 // Открыть дерикторию сайта
	 $myDirectory=opendir(".");

	// Получить файлы
	while($entryName=readdir($myDirectory)) {
	   $dirArray[]=$entryName;
	}

	// Закрыть директорию
	closedir($myDirectory);

	// Подсчёт кол-во эл файлов в массиве
	$indexCount=count($dirArray);

	// Сортировка фалов
	sort($dirArray);

	// Цикл через массив файлов
	for($index=0; $index < $indexCount; $index++) {

	// Решает, должны ли отображаться скрытые файлы в соответствии с запросом выше
	    if(substr("$dirArray[$index]", 0, 1)!=$hide) {

	//Сбрасывает переменные
		$favicon="";
		$class="file";

	// Получает имена файлов
		$name=$dirArray[$index];
		$namehref=$dirArray[$index];


	// Разделяет каталоги и выполняет операции над этими каталогам
		if(is_dir($dirArray[$index]))
		{
				$extn="<img src='../icon/fold.png' width='45%'>";
				$size="&lt;Directory&gt;";
				$sizekey="0";
				$class="dir";

				if(file_exists("$namehref/favicon.ico"))
					{
						$favicon=" style='background-image:url($namehref/favicon.ico);'";
						$extn="&lt;Website&gt;";
					}
				if($name=="."){$name=". (Current Directory)"; $extn="&lt;System Dir&gt;"; $favicon=" style='background-image:url($namehref/.favicon.ico);'";}
				if($name==".."){$name=".. (Parent Directory)"; $extn="&lt;System Dir&gt;";}
		}

	// Вывод только файлов
		else{
			// Получение файлов
			$extn=pathinfo($dirArray[$index], PATHINFO_EXTENSION);

			// Для каждой файла отдельная иконка
			switch ($extn){
				case "png": $extn="<img src='../icon/png.png' width='45%'>"; break;
				case "jpg": $extn="<img src='../icon/jpg.png' width='45%'>"; break;
				case "jpeg": $extn="<img src='../icon/jpg.png' width='45%'>"; break;
				case "svg": $extn="<img src='../icon/svg.png' width='45%'>"; break;
				case "gif": $extn="<img src='../icon/html.png' width='45%'>"; break;
				case "ico": $extn="<img src='../icon/ioc.png' width='45%'>"; break;

				case "txt": $extn="<img src='../icon/txt.png' width='45%'>"; break;
				case "log": $extn="<img src='../icon/log.png' width='45%'>"; break;
				case "htm": $extn="<img src='../icon/html.png' width='45%'>"; break;
				case "html": $extn="<img src='../icon/html.png' width='45%'>"; break;
				case "xhtml": $extn="<img src='../icon/html.png' width='45%'>"; break;
				case "shtml": $extn="<img src='../icon/html.png' width='45%'>"; break;
				case "php": $extn="<img src='../icon/php.png' width='45%'>"; break;
				case "js": $extn="<img src='../icon/Javascript.png' width='45%'>"; break;
				case "css": $extn="<img src='../icon/css.png' width='45%'>"; break;
        case "json": $extn="<img src='../icon/json-file.png' width='45%'>"; break;

				case "pdf": $extn="<img src='../icon/pdf.png' width='45%'>"; break;
				case "xls": $extn="<img src='../icon/xls.png' width='45%'>"; break;
				case "xlsx": $extn="<img src='../icon/xls.png' width='45%'>"; break;
				case "doc": $extn="<img src='../icon/doc.png' width='45%'>"; break;
        case "csv": $extn="<img src='../icon/csv.png' width='45%'>"; break;
        case "ppt": $extn="<img src='../icon/ppt.png' width='45%'>"; break;
        case "mp3": $extn="<img src='../icon/mp3.png' width='45%'>"; break;
        case "mp4": $extn="<img src='../icon/mp4.png' width='45%'>"; break;
        case "psd": $extn="<img src='../icon/psd.png' width='45%'>"; break;
				case "docx": $extn="<img src='../icon/doc.png' width='45%'>"; break;
        case "xml": $extn="<img src='../icon/xml.png' width='45%'>"; break;

				case "zip": $extn="<img src='../icon/zip.png' width='45%'>"; break;
				case "htaccess": $extn="<img src='../icon/txt.png' width='45%'>"; break;
				case "exe": $extn="<img src='../icon/exe.png' width='45%'>"; break;

				default: if($extn!=""){$extn=strtoupper($extn)." File";} else{$extn="<img src='../icon/Javascript.png' width='45%'>";} break;
			}
		}

	// Вывод
	 echo("<div class='col s2'>
               <div class='admin-content-con' align='center'>
               <a href='./$namehref'$favicon class='name'>$extn</a>
               <header>
                   <h6><a href='./$namehref'$favicon class='name'>$name</a></h6>
                 </header>
             </div>
            </div>");
  			}
		}
?>
