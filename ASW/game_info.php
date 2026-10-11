<?php require_once __DIR__ . '/i18n.php'; ?>
<!DOCTYPE html>
<html lang="<?php echo pandemic_locale(); ?>">
    <?php
    include('headers.php');
    include('functions.php');

    ?>
    <body>
        <?php include __DIR__ . '/language_selector.php'; ?>
        <header>
            <a href="index.php"><img id="logo" src="fundo.jpg"/></a>
            <h1 id="title">PANDEMIC</h1>
        </header>

        <script type="text/javascript">

          $(document).ready(function () {
              var d = new Date();
              var n = d.getHours();
              var j = d.getMinutes();
              document.getElementById("horas").innerHTML = n + ":" + j;
          });

        </script>

        <style media="screen">

          table, th, td {
            border: 1px solid black;
          }

          .controlos_jogo {
            float: right;
          }


        </style>

        <div class="controlos_jogo">
          <h3><?php echo pandemic_text('Game controls'); ?></h3>
          <button type="button"><?php echo pandemic_text('Treat disease'); ?></button>
          <button type="button"><?php echo pandemic_text('Move to another city'); ?></button>
          <button type="button"><?php echo pandemic_text('Build a research station'); ?></button>
          <button type="button"><?php echo pandemic_text('Discover a cure'); ?></button>
        </div>

        <table id="tabela1">
          <tr>
            <th><?php echo pandemic_text('Game name'); ?></th>
            <th><?php echo pandemic_text('Game start time'); ?></th>
          </tr>
          <tr>
            <td> <!--Nome do jogo a ir buscar à base de dados --> </td>
            <td id="horas"> </td>
          </tr>
        </table>
        <br>

        <table id="tabela_jogadores">
          <tr>
            <th><?php echo pandemic_text('Players'); ?></th>
            <th><?php echo pandemic_text('Cards'); ?></th>
            <th><?php echo pandemic_text('Current player'); ?></th>
            <th><?php echo pandemic_text('Location'); ?></th>
          </tr>
          <tr>
            <td><?php echo pandemic_text('Player 1'); ?></td>
            <td>Paris, Beijing</td>
            <td><?php echo pandemic_text('Yes'); ?></td>
            <td>Miami</td>
          </tr>
          <tr>
            <td><?php echo pandemic_text('Player 2'); ?></td>
            <td><?php echo pandemic_text('Rome'); ?></td>
            <td><?php echo pandemic_text('No'); ?></td>
            <td>Miami</td>
          </tr>
        </table>
        <br>
        <br>

        <table id="tabela_cidades">
          <tr>
            <th><?php echo pandemic_text('City'); ?></th>
            <th><?php echo pandemic_text('Card color'); ?></th>
            <th><?php echo pandemic_text('Connections'); ?></th>
            <th><?php echo pandemic_text('Research station'); ?></th>
            <th><?php echo pandemic_text('Disease cubes'); ?></th>
          </tr>
          <tr>
            <td>Madrid</td>
            <td><?php echo pandemic_text('Blue'); ?></td>
            <td>London, Paris, New York </td>
            <td>0</td>
            <td>0</td>
          </tr>
          <tr>
            <td>Atlanta</td>
            <td><?php echo pandemic_text('Blue'); ?></td>
            <td>Chicago, Miami, Washington </td>
            <td>0</td>
            <td>0</td>
          </tr>
          <tr>
            <td>Miami</td>
            <td><?php echo pandemic_text('Yellow'); ?></td>
            <td>Washington, Atlanta, Mexico City, Bogotá </td>
            <td>1</td>
            <td>2</td>
          </tr>
          <tr>
            <td>São Paulo</td>
            <td><?php echo pandemic_text('Yellow'); ?></td>
            <td>Buenos Aires, Bogotá, Lagos, Madrid </td>
            <td>0</td>
            <td>0</td>
          </tr>
          <tr>
            <td>Moscow</td>
            <td><?php echo pandemic_text('Black'); ?></td>
            <td>St. Petersburg, Istanbul, Tehran</td>
            <td>0</td>
            <td>1</td>
          </tr>
          <tr>
            <td><?php echo pandemic_text('Baghdad'); ?></td>
            <td><?php echo pandemic_text('Black'); ?></td>
            <td>Tehran, Istanbul, Cairo</td>
            <td>0</td>
            <td>0</td>
          </tr>
          <tr>
            <td>Tokyo</td>
            <td><?php echo pandemic_text('Red'); ?></td>
            <td>Seoul,Osaka,Shanghai,San Francisco</td>
            <td>0</td>
            <td>0</td>
          </tr>
          <tr>
            <td>Shanghai</td>
            <td><?php echo pandemic_text('Red'); ?></td>
            <td>Hong Kong,Taipei,Tokyo,Seoul,Beijing</td>
            <td>1</td>
            <td>2</td>
          </tr>

        </table>
        <br>

        <table id="tabela_surtos">
          <tr>
            <th><?php echo pandemic_text('Infection rate'); ?></th>
            <th><?php echo pandemic_text('Outbreaks'); ?></th>
            <th><?php echo pandemic_text('Research stations'); ?></th>
          </tr>
          <tr>
            <td>3</td>
            <td>0</td>
            <td>2</td>
          </tr>

        </table>
        <br>
        <table id="tabela_curas">
          <tr>
            <th><?php echo pandemic_text('Blue cure'); ?></th>
            <th><?php echo pandemic_text('Red cure'); ?></th>
            <th><?php echo pandemic_text('Black cure'); ?></th>
            <th><?php echo pandemic_text('Yellow cure'); ?></th>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        </table>


    </body>
</html>
