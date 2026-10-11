<?php require_once __DIR__ . '/i18n.php'; ?>
<!DOCTYPE html>
<html lang="<?php echo pandemic_locale(); ?>">
    <head>
        <title>Pandemic</title>
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="styles/style.css"/>
        <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript" src="script.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php include __DIR__ . '/language_selector.php'; ?>
        <header>
            <a href="index.php"><img id="logo" src="fundo.jpg"/></a>
            <h1 id="title">PANDEMIC</h1>
        </header>
        <div id="logs">
            <button id="botao_login" onclick="document.getElementById('id01').style.display = 'block'"><?php echo pandemic_text('Log in'); ?></button>
        </div>
        <div class="registo">
            <h2><?php echo pandemic_text('Register'); ?></h2>
            <!--<form action="register_form.php" method="post" id="registar">-->
            <form id="registar">
                <div class="form-group">
                    <label for="nome"><?php echo pandemic_text('First name:'); ?></label>
                    <input type="text" class="form-control" id="nome" placeholder="<?php echo pandemic_text('First name'); ?>" name="nome" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="apelido"><?php echo pandemic_text('Last name:'); ?></label>
                    <input type="text" class="form-control" id="apelido" placeholder="<?php echo pandemic_text('Last name'); ?>" name="apelido" required>
                </div>
                <br>
                <div class="form-group">
                    <div class="erro_duplicado"></div>
                    <label for="email"><?php echo pandemic_text('Email:'); ?></label>
                    <input type="email" class="form-control" id="email" placeholder="<?php echo pandemic_text('Email'); ?>" name="email" required>
                </div>
                <br>
                <div class="form-group">
                    <div class="erro_duplicado"></div>
                    <label for="nickname"><?php echo pandemic_text('Username:'); ?></label>
                    <input type="text" class="form-control" id="nick" placeholder="<?php echo pandemic_text('Username'); ?>" name="nickname" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="password"><?php echo pandemic_text('Password:'); ?></label>
                    <input type="password" class="form-control" id="pwd" placeholder="<?php echo pandemic_text('Enter password'); ?>" name="password" required>
                </div>
                <br>

                <div class="form-group">
                    <label for="sexo"><?php echo pandemic_text('Sex:'); ?></label>
                    <div class="radiobox">
                        <label><input type="radio" class="sexo" value="m" name="sexo"><?php echo pandemic_text('Male'); ?></label>
                    </div>
                    <div class="radiobox">
                        <label><input type="radio" class="sexo" value="f" name="sexo"><?php echo pandemic_text('Female'); ?></label>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="data_nascimento"><?php echo pandemic_text('Date of birth:'); ?></label>
                    <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="country"><?php echo pandemic_text('Country:'); ?></label>
                    <select class="form-country" id="pais" name="pais">
                        <option value="África do Sul"><?php echo pandemic_text('South Africa'); ?></option>
                        <option value="Albânia"><?php echo pandemic_text('Albania'); ?></option>
                        <option value="Alemanha"><?php echo pandemic_text('Germany'); ?></option>
                        <option value="Andorra">Andorra</option>
                        <option value="Angola">Angola</option>
                        <option value="Anguilla">Anguilla</option>
                        <option value="Antigua">Antigua</option>
                        <option value="Arábia Saudita"><?php echo pandemic_text('Saudi Arabia'); ?></option>
                        <option value="Argentina">Argentina</option>
                        <option value="Armênia"><?php echo pandemic_text('Armenia'); ?></option>
                        <option value="Aruba">Aruba</option>
                        <option value="Austrália"><?php echo pandemic_text('Australia'); ?></option>
                        <option value="Áustria"><?php echo pandemic_text('Austria'); ?></option>
                        <option value="Azerbaijão"><?php echo pandemic_text('Azerbaijan'); ?></option>
                        <option value="Bahamas">Bahamas</option>
                        <option value="Bahrein"><?php echo pandemic_text('Bahrain'); ?></option>
                        <option value="Bangladesh">Bangladesh</option>
                        <option value="Barbados">Barbados</option>
                        <option value="Bélgica"><?php echo pandemic_text('Belgium'); ?></option>
                        <option value="Benin">Benin</option>
                        <option value="Bermudas"><?php echo pandemic_text('Bermuda'); ?></option>
                        <option value="Botsuana"><?php echo pandemic_text('Botswana'); ?></option>
                        <option value="Brasil"><?php echo pandemic_text('Brazil'); ?></option>
                        <option value="Brunei">Brunei</option>
                        <option value="Bulgária"><?php echo pandemic_text('Bulgaria'); ?></option>
                        <option value="Burkina Fasso"><?php echo pandemic_text('Burkina Faso'); ?></option>
                        <option value="botão"><?php echo pandemic_text('Bhutan'); ?></option>
                        <option value="Cabo Verde"><?php echo pandemic_text('Cape Verde'); ?></option>
                        <option value="Camarões"><?php echo pandemic_text('Cameroon'); ?></option>
                        <option value="Camboja"><?php echo pandemic_text('Cambodia'); ?></option>
                        <option value="Canadá"><?php echo pandemic_text('Canada'); ?></option>
                        <option value="Cazaquistão"><?php echo pandemic_text('Kazakhstan'); ?></option>
                        <option value="Chade"><?php echo pandemic_text('Chad'); ?></option>
                        <option value="Chile">Chile</option>
                        <option value="China">China</option>
                        <option value="Cidade do Vaticano"><?php echo pandemic_text('Vatican City'); ?></option>
                        <option value="Colômbia"><?php echo pandemic_text('Colombia'); ?></option>
                        <option value="Congo">Congo</option>
                        <option value="Coréia do Sul"><?php echo pandemic_text('South Korea'); ?></option>
                        <option value="Costa do Marfim"><?php echo pandemic_text('Ivory Coast'); ?></option>
                        <option value="Costa Rica">Costa Rica</option>
                        <option value="Croácia"><?php echo pandemic_text('Croatia'); ?></option>
                        <option value="Dinamarca"><?php echo pandemic_text('Denmark'); ?></option>
                        <option value="Djibuti"><?php echo pandemic_text('Djibouti'); ?></option>
                        <option value="Dominica">Dominica</option>
                        <option value="EUA"><?php echo pandemic_text('United States'); ?></option>
                        <option value="Egito"><?php echo pandemic_text('Egypt'); ?></option>
                        <option value="El Salvador">El Salvador</option>
                        <option value="Emirados Árabes"><?php echo pandemic_text('United Arab Emirates'); ?></option>
                        <option value="Equador"><?php echo pandemic_text('Ecuador'); ?></option>
                        <option value="Eritréia"><?php echo pandemic_text('Eritrea'); ?></option>
                        <option value="Escócia"><?php echo pandemic_text('Scotland'); ?></option>
                        <option value="Eslováquia"><?php echo pandemic_text('Slovakia'); ?></option>
                        <option value="Eslovênia"><?php echo pandemic_text('Slovenia'); ?></option>
                        <option value="Espanha"><?php echo pandemic_text('Spain'); ?></option>
                        <option value="Estônia"><?php echo pandemic_text('Estonia'); ?></option>
                        <option value="Etiópia"><?php echo pandemic_text('Ethiopia'); ?></option>
                        <option value="Fiji">Fiji</option>
                        <option value="Filipinas"><?php echo pandemic_text('Philippines'); ?></option>
                        <option value="Finlândia"><?php echo pandemic_text('Finland'); ?></option>
                        <option value="França"><?php echo pandemic_text('France'); ?></option>
                        <option value="Gabão"><?php echo pandemic_text('Gabon'); ?></option>
                        <option value="Gâmbia"><?php echo pandemic_text('Gambia'); ?></option>
                        <option value="Gana"><?php echo pandemic_text('Ghana'); ?></option>
                        <option value="Geórgia"><?php echo pandemic_text('Georgia'); ?></option>
                        <option value="Gibraltar">Gibraltar</option>
                        <option value="Granada"><?php echo pandemic_text('Grenada'); ?></option>
                        <option value="Grécia"><?php echo pandemic_text('Greece'); ?></option>
                        <option value="Guadalupe"><?php echo pandemic_text('Guadeloupe'); ?></option>
                        <option value="Guam">Guam</option>
                        <option value="Guatemala">Guatemala</option>
                        <option value="Guiana"><?php echo pandemic_text('Guyana'); ?></option>
                        <option value="Guiana Francesa"><?php echo pandemic_text('French Guiana'); ?></option>
                        <option value="Guiné-bissau"><?php echo pandemic_text('Guinea-Bissau'); ?></option>
                        <option value="Haiti">Haiti</option>
                        <option value="Holanda"><?php echo pandemic_text('Netherlands'); ?></option>
                        <option value="Honduras">Honduras</option>
                        <option value="Hong Kong">Hong Kong</option>
                        <option value="Hungria"><?php echo pandemic_text('Hungary'); ?></option>
                        <option value="Iêmen"><?php echo pandemic_text('Yemen'); ?></option>
                        <option value="Ilhas Cayman"><?php echo pandemic_text('Cayman Islands'); ?></option>
                        <option value="Ilhas Cook"><?php echo pandemic_text('Cook Islands'); ?></option>
                        <option value="Ilhas Curaçao"><?php echo pandemic_text('Curaçao'); ?></option>
                        <option value="Ilhas Marshall"><?php echo pandemic_text('Marshall Islands'); ?></option>
                        <option value="Ilhas Turks & Caicos"><?php echo pandemic_text('Turks and Caicos Islands'); ?></option>
                        <option value="Ilhas Virgens (brit.)"><?php echo pandemic_text('British Virgin Islands'); ?></option>
                        <option value="Ilhas Virgens(amer.)"><?php echo pandemic_text('U.S. Virgin Islands'); ?></option>
                        <option value="Ilhas Wallis e Futuna"><?php echo pandemic_text('Wallis and Futuna'); ?></option>
                        <option value="Índia"><?php echo pandemic_text('India'); ?></option>
                        <option value="Indonésia"><?php echo pandemic_text('Indonesia'); ?></option>
                        <option value="Inglaterra"><?php echo pandemic_text('England'); ?></option>
                        <option value="Irlanda"><?php echo pandemic_text('Ireland'); ?></option>
                        <option value="Islândia"><?php echo pandemic_text('Iceland'); ?></option>
                        <option value="Israel">Israel</option>
                        <option value="Itália"><?php echo pandemic_text('Italy'); ?></option>
                        <option value="Jamaica">Jamaica</option>
                        <option value="Japão"><?php echo pandemic_text('Japan'); ?></option>
                        <option value="Jordânia"><?php echo pandemic_text('Jordan'); ?></option>
                        <option value="Kuwait">Kuwait</option>
                        <option value="Latvia">Latvia</option>
                        <option value="Líbano"><?php echo pandemic_text('Lebanon'); ?></option>
                        <option value="Liechtenstein">Liechtenstein</option>
                        <option value="Lituânia"><?php echo pandemic_text('Lithuania'); ?></option>
                        <option value="Luxemburgo"><?php echo pandemic_text('Luxembourg'); ?></option>
                        <option value="Macau">Macau</option>
                        <option value="Macedônia"><?php echo pandemic_text('Macedonia'); ?></option>
                        <option value="Madagascar">Madagascar</option>
                        <option value="Malásia"><?php echo pandemic_text('Malaysia'); ?></option>
                        <option value="Malaui"><?php echo pandemic_text('Malawi'); ?></option>
                        <option value="Mali">Mali</option>
                        <option value="Malta">Malta</option>
                        <option value="Marrocos"><?php echo pandemic_text('Morocco'); ?></option>
                        <option value="Martinica"><?php echo pandemic_text('Martinique'); ?></option>
                        <option value="Mauritânia"><?php echo pandemic_text('Mauritania'); ?></option>
                        <option value="Mauritius">Mauritius</option>
                        <option value="México"><?php echo pandemic_text('Mexico'); ?></option>
                        <option value="Moldova">Moldova</option>
                        <option value="Mônaco"><?php echo pandemic_text('Monaco'); ?></option>
                        <option value="Montserrat">Montserrat</option>
                        <option value="Nepal">Nepal</option>
                        <option value="Nicarágua"><?php echo pandemic_text('Nicaragua'); ?></option>
                        <option value="Niger">Niger</option>
                        <option value="Nigéria"><?php echo pandemic_text('Nigeria'); ?></option>
                        <option value="Noruega"><?php echo pandemic_text('Norway'); ?></option>
                        <option value="Nova Caledônia"><?php echo pandemic_text('New Caledonia'); ?></option>
                        <option value="Nova Zelândia"><?php echo pandemic_text('New Zealand'); ?></option>
                        <option value="Omã"><?php echo pandemic_text('Oman'); ?></option>
                        <option value="Palau">Palau</option>
                        <option value="Panamá"><?php echo pandemic_text('Panama'); ?></option>
                        <option value="Papua-nova Guiné"><?php echo pandemic_text('Papua New Guinea'); ?></option>
                        <option value="Paquistão"><?php echo pandemic_text('Pakistan'); ?></option>
                        <option value="Peru">Peru</option>
                        <option value="Polinésia Francesa"><?php echo pandemic_text('French Polynesia'); ?></option>
                        <option value="Polônia"><?php echo pandemic_text('Poland'); ?></option>
                        <option value="Porto Rico"><?php echo pandemic_text('Puerto Rico'); ?></option>
                        <option value="Portugal" selected>Portugal</option>
                        <option value="Qatar">Qatar</option>
                        <option value="Quênia"><?php echo pandemic_text('Kenya'); ?></option>
                        <option value="Rep. Dominicana"><?php echo pandemic_text('Dominican Republic'); ?></option>
                        <option value="Rep. Tcheca"><?php echo pandemic_text('Czech Republic'); ?></option>
                        <option value="Reunion">Reunion</option>
                        <option value="Romênia"><?php echo pandemic_text('Romania'); ?></option>
                        <option value="Ruanda"><?php echo pandemic_text('Rwanda'); ?></option>
                        <option value="Rússia"><?php echo pandemic_text('Russia'); ?></option>
                        <option value="Saipan">Saipan</option>
                        <option value="Samoa Americana"><?php echo pandemic_text('American Samoa'); ?></option>
                        <option value="Senegal">Senegal</option>
                        <option value="Serra Leone"><?php echo pandemic_text('Sierra Leone'); ?></option>
                        <option value="Seychelles">Seychelles</option>
                        <option value="Singapura"><?php echo pandemic_text('Singapore'); ?></option>
                        <option value="Síria"><?php echo pandemic_text('Syria'); ?></option>
                        <option value="Sri Lanka">Sri Lanka</option>
                        <option value="St. Kitts & Nevis">St. Kitts & Nevis</option>
                        <option value="St. Lúcia"><?php echo pandemic_text('St. Lucia'); ?></option>
                        <option value="St. Vincent">St. Vincent</option>
                        <option value="Sudão"><?php echo pandemic_text('Sudan'); ?></option>
                        <option value="Suécia"><?php echo pandemic_text('Sweden'); ?></option>
                        <option value="Suiça"><?php echo pandemic_text('Switzerland'); ?></option>
                        <option value="Suriname">Suriname</option>
                        <option value="Tailândia"><?php echo pandemic_text('Thailand'); ?></option>
                        <option value="Taiwan">Taiwan</option>
                        <option value="Tanzânia"><?php echo pandemic_text('Tanzania'); ?></option>
                        <option value="Togo">Togo</option>
                        <option value="Trinidad & Tobago"><?php echo pandemic_text('Trinidad and Tobago'); ?></option>
                        <option value="Tunísia"><?php echo pandemic_text('Tunisia'); ?></option>
                        <option value="Turquia"><?php echo pandemic_text('Turkey'); ?></option>
                        <option value="Ucrânia"><?php echo pandemic_text('Ukraine'); ?></option>
                        <option value="Uganda">Uganda</option>
                        <option value="Uruguai"><?php echo pandemic_text('Uruguay'); ?></option>
                        <option value="Venezuela">Venezuela</option>
                        <option value="Vietnã"><?php echo pandemic_text('Vietnam'); ?></option>
                        <option value="Zaire">Zaire</option>
                        <option value="Zâmbia"><?php echo pandemic_text('Zambia'); ?></option>
                        <option value="Zimbábue"><?php echo pandemic_text('Zimbabwe'); ?></option>
                    </select>
                </div>
                <br>
                <div class="form-group distrito">
                    <label   for="distrito"><?php echo pandemic_text('District:'); ?></label>
                    <input id="distrito" type="text" class="form-control" name="distrito" value="">
                </div>
                <br>
                <div  class="form-group concelho">
                    <label  for="concelho"><?php echo pandemic_text('Municipality:'); ?></label>
                    <input id="concelho" type="text" class="form-control" name="concelho" value="">
                </div>
                <br>
                <br>
                <button id="submeter" type="button" class="btn btn-default"><?php echo pandemic_text('Submit'); ?></button>
                <!--<button type="submit" id="submeter" onclick="" class="btn btn-default">Submit</button>-->

            </form>
        </div>
        <div class="registado_sucesso">

        </div>

        <?php include('login.php'); ?>

    </body>
    <script>
        $(document).ready(function () {
            $('.distrito').hide();
            $('.concelho').hide();

        });
        $('#submeter').click(function () {
            var nome = $('#nome').val();
            var apelido = $('#apelido').val();
            var email = $('#email').val();
            var nickname = $('#nick').val();
            var sexo = $('.sexo').val();
            var data_nascimento = $('#data_nascimento').val();
            var pais = $('#pais').val();
            var password = $('#pwd').val();
            if ($('#distrito').val()) {
                var distrito = $('#distrito').val();
            } else {
                var distrito = null;
            }
            if ($('#concelho').val()) {
                var concelho = $('#concelho').val();
            } else {
                var concelho = null;
            }

            $.ajax({

                url: 'register_form.php',
                type: 'POST',
                data: {
                    email: email,
                    nome: nome,
                    apelido: apelido,
                    nickname: nickname,
                    sexo: sexo,
                    data_nascimento: data_nascimento,
                    pais: pais,
                    distrito: distrito,
                    concelho: concelho,
                    password: password,
                },
                success: function (msg) {
                    if (msg == "success") {
                        $('.registo').hide();
                        $('.registado_sucesso').append(<?php echo pandemic_js_markup('<div>Registration successful! You can now log in.</div>'); ?>);
                    } else if (msg == "duplicado") {
                        $(".erro_duplicado").append(<?php echo pandemic_js_markup('<div>That username is already taken.</div>'); ?>);
                    }
                }
            });
        });
    </script>
</html>
