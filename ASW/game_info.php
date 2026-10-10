<!DOCTYPE html>
<html lang="en">
    <?php
    include('headers.php');
    include('functions.php');

    ?>
    <body>
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
          <h3>Game controls</h3>
          <button type="button">Treat disease</button>
          <button type="button">Move to another city</button>
          <button type="button">Build a research station</button>
          <button type="button">Discover a cure</button>
        </div>

        <table id="tabela1">
          <tr>
            <th>Game name</th>
            <th>Game start time</th>
          </tr>
          <tr>
            <td> <!--Nome do jogo a ir buscar à base de dados --> </td>
            <td id="horas"> </td>
          </tr>
        </table>
        <br>

        <table id="tabela_jogadores">
          <tr>
            <th>Players</th>
            <th>Cards</th>
            <th>Current player</th>
            <th>Location</th>
          </tr>
          <tr>
            <td>Player 1</td>
            <td>Paris, Beijing</td>
            <td>Yes</td>
            <td>Miami</td>
          </tr>
          <tr>
            <td>Player 2</td>
            <td>Rome</td>
            <td>No</td>
            <td>Miami</td>
          </tr>
        </table>
        <br>
        <br>

        <table id="tabela_cidades">
          <tr>
            <th>City</th>
            <th>Card color</th>
            <th>Connections</th>
            <th>Research station</th>
            <th>Disease cubes</th>
          </tr>
          <tr>
            <td>Madrid</td>
            <td>Blue</td>
            <td>London, Paris, New York </td>
            <td>0</td>
            <td>0</td>
          </tr>
          <tr>
            <td>Atlanta</td>
            <td>Blue</td>
            <td>Chicago, Miami, Washington </td>
            <td>0</td>
            <td>0</td>
          </tr>
          <tr>
            <td>Miami</td>
            <td>Yellow</td>
            <td>Washington, Atlanta, Mexico City, Bogotá </td>
            <td>1</td>
            <td>2</td>
          </tr>
          <tr>
            <td>São Paulo</td>
            <td>Yellow</td>
            <td>Buenos Aires, Bogotá, Lagos, Madrid </td>
            <td>0</td>
            <td>0</td>
          </tr>
          <tr>
            <td>Moscow</td>
            <td>Black</td>
            <td>St. Petersburg, Istanbul, Tehran</td>
            <td>0</td>
            <td>1</td>
          </tr>
          <tr>
            <td>Baghdad</td>
            <td>Black</td>
            <td>Tehran, Istanbul, Cairo</td>
            <td>0</td>
            <td>0</td>
          </tr>
          <tr>
            <td>Tokyo</td>
            <td>Red</td>
            <td>Seoul,Osaka,Shanghai,San Francisco</td>
            <td>0</td>
            <td>0</td>
          </tr>
          <tr>
            <td>Shanghai</td>
            <td>Red</td>
            <td>Hong Kong,Taipei,Tokyo,Seoul,Beijing</td>
            <td>1</td>
            <td>2</td>
          </tr>

        </table>
        <br>

        <table id="tabela_surtos">
          <tr>
            <th>Infection rate</th>
            <th>Outbreaks</th>
            <th>Research stations</th>
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
            <th>Blue cure</th>
            <th>Red cure</th>
            <th>Black cure</th>
            <th>Yellow cure</th>
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
