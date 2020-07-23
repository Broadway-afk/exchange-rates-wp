<h1>Курсы валют по отношению к рублю за <?php echo date("d.m.Y"); ?></h1>

<?php
$data = wp_remote_get( 'http://www.cbr.ru/scripts/XML_daily.asp' );
if ( wp_remote_retrieve_response_message( $data ) != 'OK' || is_wp_error( $data ) ) {
    echo 'data not available'; die;
}

$data = wp_remote_retrieve_body( $data );
$data = simplexml_load_string( $data );
?>

<table class="rate_table">
    <tr>
        <td>Код валюты</td>
        <td>Название валюты</td>
        <td>Курс</td>
    </tr>
    <?php
    $barrel = '';
    foreach ( $data->Valute as $valute ) {
        $barrel .= "
          <tr>
            <td>$valute->CharCode</td>
            <td>$valute->Name</td>
            <td>$valute->Value</td>
          </tr>
      ";
    }
    echo $barrel;
    ?>

</table>