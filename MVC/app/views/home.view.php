<?php
include "/xampp/htdocs/marcimvc/MVC/app/views/header.view.php";
?>

<main>
            <div class="login" id="login">
                <div class="login1">
                    <?php if(isset($user->Name)):?>
                        <?php echo"<span ><a href="?><?=ROOT?><?php echo"/logout class='loginOdkaz' >Ohlásit</a></span>";?>
                        <?php echo"<span ><a href="?><?=ROOT?><?php echo"/delete class='loginOdkaz' >Smazat účet</a></span>";?>
                        <?php else:?>
                        <?php echo"<span ><a href="?><?=ROOT?><?php echo"/login class='loginOdkaz' >Přihlásit</a></span>";?>
                        <?php echo"<span ><a href="?><?=ROOT?><?php echo"/sign class='loginOdkaz' >Založit nový účet</a></span>";?>
                    <?php endif;?>
                </div>
             
            </div>
            <div>
                <?php if(isset($user->Name)):?><?php echo "<div class='info'><span>".$user->Name."</span></div>"; ?><?php endif;?>
                <?php if(!empty($user->answers['delete'])):?><?php echo "<div class='info'><span>".$user->answers['delete']."</span></div>"; ?><?php endif;?>
            </div>
                 
<div class="uzivatel"><span> <p> </p></span></div>
        
        <div class="container1">
              
                <div class="ucetnictvi">
                    <h1 class="Domaci">Domácí e-účetnictví</h1>
                    <p class="home">Poskytuji účetnictví daňové a podvojné pro malé a střední podnikatele.</p>
                    <img src="../public/assests/images/img/feather.svg" alt="" class="homeImg1">

                    <div class="odkazy">
                        <div class="linky">
                        <a href="#" ><img src="../public/assests/images/img/linkedin.png" class="foto"></a></div>
                        <div class="linky">
                        <a href="#"><img src="../public/assests/images/img/twitter.png" class="foto"></a></div>
                        <div class="linky">
                        <a href="#"><img src="../public/assests/images/img/instagram1.png" class="foto"></a></div>
                        <div class="linky">
                        <a href="#"><img src="../public/assests/images/img/facebook.png" class="foto"></a></div>
                        <div class="linky">
                        <a href="#"><img src="../public/assests/images/img/telegram.png" class="foto"></a></div>
                    </div>

               
                </div>
        </div>
       
        <div class="container3" id="cenik">

            <div><h2 class="Domaci">Jaké domácí ceny jsem Vám schopna nabídnout?</h2></div>
           
            <div class="cenikfoto">
                <div class="obrazek1"><a href="#"><img src="../public/assests/images/img/company.jpg" alt="" class="obr1"></a>
                    <div class="text1"><h5>Podvojné účetnictví</h5><p>lorem ipsum ferris inabi tekume nas ti be rio mena</p>
                        <div class="cena1">2 500 Kč</div></div></div>



                <div class="obrazek2"><a href="#"><img src="../public/assests/images/img/india.jpg" alt="" class="obr2"></a>
                    <div class="text2"><h5>Podvojné účetnictví</h5><p>lorem ipsum ferris inabi tekume nas ti be rio mena</p>
                        <div class="cena1">2 500 Kč</div></div></div>



                <div class="obrazek3"><a href="#"><img src="../public/assests/images/img/money.jpg" alt="" class="obr3"></a>
                    <div class="text3"><h5>Podvojné účetnictví</h5><p>lorem ipsum ferris inabi tekume nas ti be rio mena</p>
                        <div class="cena1">2 500 Kč</div></div></div>
            </div>
            
        </div>
        <div class="linie"></div>

        <div class="container4" id="omne">
            <div><h1 class="DomaciOmne">Praxe a zkušenosti</h1>
                <p class="homeOmne">Jsme účetní s 30 letou pracovní zkušeností dělám obcím i podnikatelům mzdy i daňovou agendu. Mám dlouholeté zkušenosti a řadu spokojených zákazníků.

                    Mým cílem je poskytovat klientům komplexní servis v oblasti účetních služeb. To Vám umožní věnovat se plně tomu, co umíte nejlépe, tedy podnikání. Starosti s papírováním můžete nechat na mně, čímž zefektivníte svoje podnikání.
                    
                    Při své práci klademe důraz především na osobní přístup k zákazníkům, preciznost a přesnost, které jsou v tomto oboru základem.</p></div>
                <img src="../public/assests/images/img/Pero.svg" alt="" class="homeImg">
            </div>


        <div class="linie"></div>

        
        <div class="containerSize" id="registrace">
        <div class="container5">
        
            <div class="title">Dejte mi vědět o svých potřebách.</div>


                    <form action="#formular" method="POST" class="form-border" id="form" autocomplete="on">
                        <div class="user-details">

                            <div class="input-box">
                                <label for="username" class="details">Celé jméno:</label>
                                <Input type="text" id="username" name="Username_post" placeholder="Jméno a přijmení" required ></div>
                               

                            <div id="formular" class="input-box">
                                <label for="e-mail" class="details">E-mail:</label>
                                <input type="email" id="e-mail"placeholder="Zadejte E-mail" name="Email" required></div>



                            <div class="input-box">
                                <label for="phone" class="details">Váš telefon:</label>
                                <input type="telefon" id="phone" placeholder="Telefonní číslo" name="Phone" required></div>

                            <div class="input-box">
                                <label for="obrat" class="details">Roční obrat (Kč):</label>
                                <input type="text" id="obrat"  placeholder="Roční obrat v Kč " name="Annual_turnover" required ></div>


                            <div class="input-box">
                                <label for="karts" class="details">Hmotný i nehmo. majetek:</label>
                                <input type="text" id="karts" placeholder="Počet Inv. karet" name="Property_cards" required></div>


                            <div class="input-box">
                                <label for="employes" class="details">Počet zaměstnanců:</label>
                                <input type="text" id="employes" placeholder="Počet zaměstnanců" name="Employe" required></div>



                            <div class="input-box">
                                <label for="doklady" class="details">Počet dokladů:</label>
                                <input  id="doklady" type="Celkový počet dokladů" placeholder="Celkový počet dokladů" name="Documents" required></div>

                            <div class="input-box">
                                <label for="forma" class="details">Právní forma</label>   
                                <input id="forma" type="text" placeholder="s.r.o. nebo jiné" name="Legal_form" required></div> 
                                
                            <div class="input-box">
                                <label for="podnikání"class="details">Předmět podnikání</label>
                                <input id="podnikání" type="text" placeholder="Předmět podnikání" name="Business" required></div> 

                        </div>   
                        <div class="selects">
                            <div class="select1">
                                <label for="zájem" class="selectInfo" required>Mám zájem o</label>
                                <select name="Interest" id="zájem" class="SO" required >
                                    <option value="">Vyberte</option>
                                    <option value="Podvojné účetnictví">Podvojné účetnictví</option>
                                    <option value="Daňová Evidence">Daňová evidence</option>
                                    <option value="Mzdová a personální agenda">Mzdová a personální agenda</option>
                                </select></div>


                            <div class="select2">
                                <label for="DPH" class="selectInfo" required>Jste plátce DPH?</label>     
                                <select name="TaxPay" id="DPH" class="SO" required>
                                    <option value="">Vyberte</option>
                                    <option value="Ne">Ne, nejsem</option>
                                    <option value="Měsíční">Ano, měsíční</option>
                                    <option value="Čtvrtletní">Ano, čtvrtletní</option>
                                </select>
                            </div>
                                
                        </div>      


                        <div class="textarea">
                                <label for="informace" class="doplnInfo">Doplňující Informace</label>
                                <textarea  class="textA" name="Info" id="informace" cols="20" rows="10"></textarea>
                                <input  name="submit" type="submit" class="sub">
                        </div>

                    </form>
                    <br>
                    <br>
                    <?php if(isset($answer)):?><?php echo "<div class='info'><span>".$answer."</span></div>"; ?><?php endif;?>              
                    <?php if(!empty($errors)):?><div class="alert"><p class=""><?php echo implode("<br>",$errors);?></p></div><?php endif; ?></div>
                    
                    
    </main>
    <footer>
        <div class=" container">


            <div class="contact" id="kontakt">
                
                <div class="kontakty">
                    <div class="adressa"> Rybáře 210/24 Tvrdonice 691 53
                    <span class="material-icons"><img src="./img/ikona_lokace.png" alt="">
                        </span></div>
                    <div class="ico">IČO: cz52484364856413
                        <span class="material-icons">
                            <img src="./img/ikona_ico.png" alt="">
                            </span>
                    </div>
                    <div class="telefon">+420 555 777 888
                        <span class="material-icons">
                            <img src="./img/ikona_telefon.png" alt="">
                            </span>
                    </div>
                    <div class="email">marcelasalajkova@ucto.cz
    
                        <span class="material-icons">
                            <img src="./img/ikona_email.png" alt="">
                            </span>     
    
                    </div>
                    <div class="datovka">Identifikátor datovky: 542348
                        <span class="material-icons">
                            <img src="./img/ikona_klic.png" alt="">
                            </span>  
                           
                    
                </div>
    
    
            </div>
        </div>

    </footer>
</body>
<!-- <script type="text/javascript" src="./validatory/ValidateRegistr.js"></script>
 <script type="text/javascript" src="./validatory/ValidateResponses.js"></script> -->


</html>





