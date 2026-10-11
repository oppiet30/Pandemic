<!DOCTYPE html>
<html lang="en">
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
        <header>
            <a href="index.php"><img id="logo" src="fundo.jpg"/></a>
            <h1 id="title">PANDEMIC</h1>
        </header>
        <div id="logs">
            <button id="botao_login" onclick="document.getElementById('id01').style.display = 'block'">Log in</button>
        </div>
        <div class="registo">
            <h2>Register</h2>
            <!--<form action="register_form.php" method="post" id="registar">-->
            <form id="registar">
                <div class="form-group">
                    <label for="nome">First name:</label>
                    <input type="text" class="form-control" id="nome" placeholder="First name" name="nome" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="apelido">Last name:</label>
                    <input type="text" class="form-control" id="apelido" placeholder="Last name" name="apelido" required>
                </div>
                <br>
                <div class="form-group">
                    <div class="erro_duplicado"></div>
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
                </div>
                <br>
                <div class="form-group">
                    <div class="erro_duplicado"></div>
                    <label for="nickname">Username:</label>
                    <input type="text" class="form-control" id="nick" placeholder="Username" name="nickname" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password" required>
                </div>
                <br>

                <div class="form-group">
                    <label for="sexo">Sex:</label>
                    <div class="radiobox">
                        <label><input type="radio" class="sexo" value="m" name="sexo">Male</label>
                    </div>
                    <div class="radiobox">
                        <label><input type="radio" class="sexo" value="f" name="sexo">Female</label>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="data_nascimento">Date of birth:</label>
                    <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="country">Country:</label>
                    <select class="form-country" id="pais" name="pais">
                        <option value="África do Sul">South Africa</option>
                        <option value="Albânia">Albania</option>
                        <option value="Alemanha">Germany</option>
                        <option value="Andorra">Andorra</option>
                        <option value="Angola">Angola</option>
                        <option value="Anguilla">Anguilla</option>
                        <option value="Antigua">Antigua</option>
                        <option value="Arábia Saudita">Saudi Arabia</option>
                        <option value="Argentina">Argentina</option>
                        <option value="Armênia">Armenia</option>
                        <option value="Aruba">Aruba</option>
                        <option value="Austrália">Australia</option>
                        <option value="Áustria">Austria</option>
                        <option value="Azerbaijão">Azerbaijan</option>
                        <option value="Bahamas">Bahamas</option>
                        <option value="Bahrein">Bahrain</option>
                        <option value="Bangladesh">Bangladesh</option>
                        <option value="Barbados">Barbados</option>
                        <option value="Bélgica">Belgium</option>
                        <option value="Benin">Benin</option>
                        <option value="Bermudas">Bermuda</option>
                        <option value="Botsuana">Botswana</option>
                        <option value="Brasil">Brazil</option>
                        <option value="Brunei">Brunei</option>
                        <option value="Bulgária">Bulgaria</option>
                        <option value="Burkina Fasso">Burkina Faso</option>
                        <option value="botão">Bhutan</option>
                        <option value="Cabo Verde">Cape Verde</option>
                        <option value="Camarões">Cameroon</option>
                        <option value="Camboja">Cambodia</option>
                        <option value="Canadá">Canada</option>
                        <option value="Cazaquistão">Kazakhstan</option>
                        <option value="Chade">Chad</option>
                        <option value="Chile">Chile</option>
                        <option value="China">China</option>
                        <option value="Cidade do Vaticano">Vatican City</option>
                        <option value="Colômbia">Colombia</option>
                        <option value="Congo">Congo</option>
                        <option value="Coréia do Sul">South Korea</option>
                        <option value="Costa do Marfim">Ivory Coast</option>
                        <option value="Costa Rica">Costa Rica</option>
                        <option value="Croácia">Croatia</option>
                        <option value="Dinamarca">Denmark</option>
                        <option value="Djibuti">Djibouti</option>
                        <option value="Dominica">Dominica</option>
                        <option value="EUA">United States</option>
                        <option value="Egito">Egypt</option>
                        <option value="El Salvador">El Salvador</option>
                        <option value="Emirados Árabes">United Arab Emirates</option>
                        <option value="Equador">Ecuador</option>
                        <option value="Eritréia">Eritrea</option>
                        <option value="Escócia">Scotland</option>
                        <option value="Eslováquia">Slovakia</option>
                        <option value="Eslovênia">Slovenia</option>
                        <option value="Espanha">Spain</option>
                        <option value="Estônia">Estonia</option>
                        <option value="Etiópia">Ethiopia</option>
                        <option value="Fiji">Fiji</option>
                        <option value="Filipinas">Philippines</option>
                        <option value="Finlândia">Finland</option>
                        <option value="França">France</option>
                        <option value="Gabão">Gabon</option>
                        <option value="Gâmbia">Gambia</option>
                        <option value="Gana">Ghana</option>
                        <option value="Geórgia">Georgia</option>
                        <option value="Gibraltar">Gibraltar</option>
                        <option value="Granada">Grenada</option>
                        <option value="Grécia">Greece</option>
                        <option value="Guadalupe">Guadeloupe</option>
                        <option value="Guam">Guam</option>
                        <option value="Guatemala">Guatemala</option>
                        <option value="Guiana">Guyana</option>
                        <option value="Guiana Francesa">French Guiana</option>
                        <option value="Guiné-bissau">Guinea-Bissau</option>
                        <option value="Haiti">Haiti</option>
                        <option value="Holanda">Netherlands</option>
                        <option value="Honduras">Honduras</option>
                        <option value="Hong Kong">Hong Kong</option>
                        <option value="Hungria">Hungary</option>
                        <option value="Iêmen">Yemen</option>
                        <option value="Ilhas Cayman">Cayman Islands</option>
                        <option value="Ilhas Cook">Cook Islands</option>
                        <option value="Ilhas Curaçao">Curaçao</option>
                        <option value="Ilhas Marshall">Marshall Islands</option>
                        <option value="Ilhas Turks & Caicos">Turks and Caicos Islands</option>
                        <option value="Ilhas Virgens (brit.)">British Virgin Islands</option>
                        <option value="Ilhas Virgens(amer.)">U.S. Virgin Islands</option>
                        <option value="Ilhas Wallis e Futuna">Wallis and Futuna</option>
                        <option value="Índia">India</option>
                        <option value="Indonésia">Indonesia</option>
                        <option value="Inglaterra">England</option>
                        <option value="Irlanda">Ireland</option>
                        <option value="Islândia">Iceland</option>
                        <option value="Israel">Israel</option>
                        <option value="Itália">Italy</option>
                        <option value="Jamaica">Jamaica</option>
                        <option value="Japão">Japan</option>
                        <option value="Jordânia">Jordan</option>
                        <option value="Kuwait">Kuwait</option>
                        <option value="Latvia">Latvia</option>
                        <option value="Líbano">Lebanon</option>
                        <option value="Liechtenstein">Liechtenstein</option>
                        <option value="Lituânia">Lithuania</option>
                        <option value="Luxemburgo">Luxembourg</option>
                        <option value="Macau">Macau</option>
                        <option value="Macedônia">Macedonia</option>
                        <option value="Madagascar">Madagascar</option>
                        <option value="Malásia">Malaysia</option>
                        <option value="Malaui">Malawi</option>
                        <option value="Mali">Mali</option>
                        <option value="Malta">Malta</option>
                        <option value="Marrocos">Morocco</option>
                        <option value="Martinica">Martinique</option>
                        <option value="Mauritânia">Mauritania</option>
                        <option value="Mauritius">Mauritius</option>
                        <option value="México">Mexico</option>
                        <option value="Moldova">Moldova</option>
                        <option value="Mônaco">Monaco</option>
                        <option value="Montserrat">Montserrat</option>
                        <option value="Nepal">Nepal</option>
                        <option value="Nicarágua">Nicaragua</option>
                        <option value="Niger">Niger</option>
                        <option value="Nigéria">Nigeria</option>
                        <option value="Noruega">Norway</option>
                        <option value="Nova Caledônia">New Caledonia</option>
                        <option value="Nova Zelândia">New Zealand</option>
                        <option value="Omã">Oman</option>
                        <option value="Palau">Palau</option>
                        <option value="Panamá">Panama</option>
                        <option value="Papua-nova Guiné">Papua New Guinea</option>
                        <option value="Paquistão">Pakistan</option>
                        <option value="Peru">Peru</option>
                        <option value="Polinésia Francesa">French Polynesia</option>
                        <option value="Polônia">Poland</option>
                        <option value="Porto Rico">Puerto Rico</option>
                        <option value="Portugal" selected>Portugal</option>
                        <option value="Qatar">Qatar</option>
                        <option value="Quênia">Kenya</option>
                        <option value="Rep. Dominicana">Dominican Republic</option>
                        <option value="Rep. Tcheca">Czech Republic</option>
                        <option value="Reunion">Reunion</option>
                        <option value="Romênia">Romania</option>
                        <option value="Ruanda">Rwanda</option>
                        <option value="Rússia">Russia</option>
                        <option value="Saipan">Saipan</option>
                        <option value="Samoa Americana">American Samoa</option>
                        <option value="Senegal">Senegal</option>
                        <option value="Serra Leone">Sierra Leone</option>
                        <option value="Seychelles">Seychelles</option>
                        <option value="Singapura">Singapore</option>
                        <option value="Síria">Syria</option>
                        <option value="Sri Lanka">Sri Lanka</option>
                        <option value="St. Kitts & Nevis">St. Kitts & Nevis</option>
                        <option value="St. Lúcia">St. Lucia</option>
                        <option value="St. Vincent">St. Vincent</option>
                        <option value="Sudão">Sudan</option>
                        <option value="Suécia">Sweden</option>
                        <option value="Suiça">Switzerland</option>
                        <option value="Suriname">Suriname</option>
                        <option value="Tailândia">Thailand</option>
                        <option value="Taiwan">Taiwan</option>
                        <option value="Tanzânia">Tanzania</option>
                        <option value="Togo">Togo</option>
                        <option value="Trinidad & Tobago">Trinidad and Tobago</option>
                        <option value="Tunísia">Tunisia</option>
                        <option value="Turquia">Turkey</option>
                        <option value="Ucrânia">Ukraine</option>
                        <option value="Uganda">Uganda</option>
                        <option value="Uruguai">Uruguay</option>
                        <option value="Venezuela">Venezuela</option>
                        <option value="Vietnã">Vietnam</option>
                        <option value="Zaire">Zaire</option>
                        <option value="Zâmbia">Zambia</option>
                        <option value="Zimbábue">Zimbabwe</option>
                    </select>
                </div>
                <br>
                <div class="form-group distrito">
                    <label   for="distrito">District:</label>
                    <input id="distrito" type="text" class="form-control" name="distrito" value="">
                </div>
                <br>
                <div  class="form-group concelho">
                    <label  for="concelho">Municipality:</label>
                    <input id="concelho" type="text" class="form-control" name="concelho" value="">
                </div>
                <br>
                <br>
                <button id="submeter" type="button" class="btn btn-default">Submit</button>
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
                        $('.registado_sucesso').append("<div>Registration successful! You can now log in.</div>");
                    } else if (msg == "duplicado") {
                        $(".erro_duplicado").append("<div>That username is already taken.</div>");
                    }
                }
            });
        });
    </script>
</html>
