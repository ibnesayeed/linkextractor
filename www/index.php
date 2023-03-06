<!DOCTYPE html>

<?php
  $api_endpoint = $_ENV["API_ENDPOINT"] ?: "http://localhost:5000/api/";
  $url = "";
  if(isset($_GET["url"]) && $_GET["url"] != "") {
    $url = $_GET["url"];
    $json = @file_get_contents($api_endpoint . $url);
    if($json == false) {
      $err = "Something is wrong with the URL: " . $url;
    } else {
      $links = json_decode($json, true);
      $domains = [];
      foreach($links as $link) {
        array_push($domains, parse_url($link["href"], PHP_URL_HOST));
      }
      $domainct = @array_count_values($domains);
      arsort($domainct);
    }
  }
?>

<html>
  <head>
    <meta charset="utf-8">
    <title>Link Extractor</title>
    <style media="screen">
      html {
        background: #EAE7D6;
        font-family: sans-serif;
      }
      body {
        margin: 0;
      }
      h1 {
        padding: 10px;
        margin: 0 auto;
        color: #EAE7D6;
        max-width: 600px;
      }
      h1 a {
        text-decoration: none;
        color: #EAE7D6;
      }
      h2 {
        background: #082E41;
        color: #EAE7D6;
        margin: -10px;
        padding: 10px;
      }
      p {
        margin: 25px 5px 5px;
      }
      section {
        max-width: 600px;
        margin: 10px auto;
        padding: 10px;
        border: 1px solid #082E41;
      }
      div.header {
        background: #082E41;
        margin: 0;
      }
      div.footer {
        background: #082E41;
        margin: 0;
        padding: 5px;
      }
      .footer p {
        margin: 0 auto;
        max-width: 600px;
        color: #EAE7D6;
        text-align: center;
      }
      .footer p a {
        color: #24C2CB;
        text-decoration: none;
      }
      .error {
        color: #DA2536;
      }
      form {
        display: flex;
      }
      input {
        font-size: 20px;
        padding: 3px;
        height: 40px;
      }
      input.text {
        box-sizing:border-box;
        flex-grow: 1;
        border-color: #082E41;
      }
      input.button {
        width: 150px;
        background: #082E41;
        border-color: #082E41;
        color: #EAE7D6;
      }
      table {
        width: 100%;
        text-align: left;
        margin-top: 10px;
      }
      table th, table td {
        padding: 3px;
      }
      table th:last-child, table td:last-child {
        width: 70px;
        text-align: right;
      }
      table th {
        border-top: 1px solid #082E41;
        border-bottom: 1px solid #082E41;
      }
      table tr:last-child td {
        border-top: 1px solid #082E41;
        border-bottom: 1px solid #082E41;
      }
    </style>
  </head>
  <body>
    <div class="header">
      <h1><a href="/">Link Extractor</a></h1>
    </div>

    <section>
      <form action="/">
        <input class="text" type="text" name="url" placeholder="http://example.com/" value="<?php echo $url; ?>">
        <input class="button" type="submit" value="Extract Links">
      </form>
    </section>
    
    <?php if(isset($err)): ?>
      <section>
        <h2>Error</h2>
        <p class="error"><?php echo $err; ?></p>
      </section>
    <?php endif; ?>

    <?php if($url != "" && !isset($err)): ?>
      <section>
        <h2>Summary</h2>
        <p>
          <strong>Page:</strong> <?php echo "<a href=\"" . $url . "\">" . $url . "</a>"; ?>
        </p>
        <table>
          <tr>
            <th>Domain</th>
            <th># Links</th>
          </tr>
          <?php
            foreach($domainct as $key => $value) {
              echo "<tr>";
              echo "<td>" . $key . "</td>";
              echo "<td>" . $value . "</td>";
              echo "</tr>";
            }
          ?>
          <tr>
            <td><strong>Total</strong></td>
            <td><strong><?php echo count($links); ?></strong></td>
          </tr>
        </table>
      </section>

      <section>
        <h2>Links</h2>
        <ul>
        <?php
          foreach($links as $link) {
            echo "<li><a href=\"" . $link["href"] . "\">" . $link["text"] . "</a></li>";
          }
        ?>
        </ul>
      </section>
    <?php endif; ?>

    <div class="footer">
      <p><a href="https://github.com/ibnesayeed/linkextractor">Link Extractor</a> by <a href="https://twitter.com/ibnesayeed">@ibnesayeed</a> from
        <a href="https://ws-dl.cs.odu.edu/">WS-DL, ODU</a>
      </p>
    </div>
  </body>
</html>
