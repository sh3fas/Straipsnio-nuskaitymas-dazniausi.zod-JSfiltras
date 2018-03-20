   <!doctype html>
    <html lang="en">
     <head>
         <meta charset="utf-8">
         
         <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
         <script type="text/javascript" src="js/highlight.js"></script>
         
     </head>
     <body>
         <?php 

        /*
            $url = 'https://www.15min.lt/pasaulis-kiseneje/naujiena/kelioniu-ekspertas/sausio-akcijos-kurie-europos-miestai-yra-geriausi-ziemos-ispardavimams-638-902708';


            $content = file_get_contents($url);
            $content1 = str_replace(array("<",">"), array ("(",")"), $content);
            echo $content1;
        */

        /*
            regular expression php
            arba
            explode()
        */
        ?>
    <style>
        html {
            background-image: url(http://feastsforallseasons.com/wp-content/uploads/2011/11/canvas-texture-paper.jpg);
            color: #333333;
        }
        
        .head {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        
        .content {
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }
        
        .highlight {
            background-color: yellow;
            font-weight: bold;
        }
        
        .nonehight{
            background-color: none;
            font-weight: normal;
        }
    </style>
        <div class="body" style="width: 1000px; margin: 0 auto; font-family: Roboto,RobotoLocal,sans-serif; background-color: white; ">
                <div class="head" style="border: 1px solid black; text-align: center; background-color: #404040">
                        <h2 style='color: white;'>STRAIPSNIO ANALIZĖ</h2>
                    <span style='color: #00cf53'>Veikia su visais 15min.lt straipsniais</span>
                </div>

                <div class="link" style="border: 1px solid black; border-top: none; padding: 10px 10px 0 10px;">
                    <form action="straipsnis.php" method="POST">
                    Nuoroda į straipsnį: 

                    <input style="width: 77%;" type='text' name='name' />
                    <input type="submit" value="Analizuoti" style="border-radius: 3px;"/>

                    </form>
                </div>
                
                <div class="content" style="border: 1px solid black; border-top: none; padding: 10px 10px 0 10px;">
                    <?php
                        // straipsnio suradimo formavimas
                        require('simple_html_dom.php');
                        
                        if (isset($_POST["name"])) {
                        $website = $_REQUEST["name"];
                        $html = file_get_html($website);

                        $title = $html->find('h1',0)->plaintext;
                        $intro = $html->find('h4',0)->plaintext;
                        $text = $html->find('div.text',0)->plaintext;
                        // straipsnio suradimo formavimo pabaiga
                            
                            // pasikartojanciu zodziu isvedimas
                            $texts = explode(' ',$text); 
                            foreach ($texts as $key => $word ) { 
                                if (strlen($word) > 5) { 
                                    $words[] = $word; 
                                    } 
                                } 
                            $count = array_count_values($words); 
                            array_multisort($count,SORT_DESC); 
                            $i = 1; 
                            echo '<div id="words" style="border-bottom: solid black 1px; padding-bottom: 15px;">';
                            echo "<Br>";
                            echo '<b>Dažniausi žodžiai: </b>';
                            
                            foreach ($count as $key => $value) { 
                                if( $i <= 10 ) { 
                                    $keyword[] = $key;    
                                    echo '<span style="padding-right: 15px;" class="zodziai" id='.$i.' value='.$key.'><u>'.$key.' ('.$value.')</u></span>'; 
                                    $i++; 
                                    } 
                                  }
                            echo '<b> - (paspaudus žodį paryškinti tekste)</b></div>';
                            echo "<Br>";
                            // pasikartojanciu zodziu isvedimo pabaiga
                            
                    // straipsnio teksto isvedimas
                        echo "<b>".$title."</b>";
                        echo '<br><br>';
                        echo "<p>".$intro."</p>";
                        echo '<br>';
                        echo "<p>".$text."</p>";
                            
                        } else {
                            echo "<b>Nepateikta nuoroda</b>";
                        }
                    // isvedimo pabaiga
                        
                    ?>
                    <Br />
                    <br />
                </div>
            </div>
            <script type="text/javascript">

                
                        /// filtras zodziu paryskita, ir tekste randa ir paryskina
                        $(document).ready(function (){
                            $('span').click(function(){
                                $(this).addClass('highlight').siblings().removeClass('highlight');
                                var test = $(this).attr('value');
                                $("p").removeHighlight().highlight(test);
                            });
                        });
                
                        /// filtras zodziu panaikina paryskinimus
                         $(document).ready(function (){
                            $( "span" ).dblclick(function() {
                                $(this).removeClass('highlight');
                                var test = $(this).attr('value');
                                $("p").removeHighlight(test);
                            });
                        });
                        
                    </script>
            
          </body>
        </html>