<?php
function get_lat_lng( $address ) {
  $address = rawurlencode( $address );
  $coord   = get_transient( 'geocode_' . $address );
  if( empty( $coord ) ) {
    $url  = 'http://nominatim.openstreetmap.org/?format=json&addressdetails=1&q=' . $address . '&format=json&limit=1';
    $json = wp_remote_get( $url );
    if ( 200 === (int) wp_remote_retrieve_response_code( $json ) ) {
      $body = wp_remote_retrieve_body( $json );
      $json = json_decode( $body, true );
    }

    $coord['lat']  = $json[0]['lat'];
    $coord['long'] = $json[0]['lon'];
    set_transient( 'geocode_' . $address, $coord, DAY_IN_SECONDS * 90 );
  }
  return $coord;

}
