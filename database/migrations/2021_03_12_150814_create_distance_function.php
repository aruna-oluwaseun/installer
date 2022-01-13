<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistanceFunction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       \Illuminate\Support\Facades\DB::unprepared("
       DROP FUNCTION IF EXISTS DISTANCE;
       CREATE FUNCTION `DISTANCE`( lat1 DOUBLE, lon1 DOUBLE, lat2 DOUBLE, lon2 DOUBLE, unit ENUM( 'MILE', 'KILOMETER', 'MI', 'KM' ) ) RETURNS double
        BEGIN
          DECLARE dist    DOUBLE;
          DECLARE latDist DOUBLE;
          DECLARE lonDist DOUBLE;
          DECLARE a,c,r   DOUBLE;

            IF unit = 'MILE' OR unit = 'MI' THEN SET r = 3959;
          ELSE SET r = 6371;
          END IF;

            SET latDist = RADIANS( lat2 - lat1 );
          SET lonDist = RADIANS( lon2 - lon1 );
          SET a = POW( SIN( latDist/2 ), 2 ) + COS( RADIANS( lat1 ) ) * COS( RADIANS( lat2 ) ) * POW( SIN( lonDist / 2 ), 2 );
          SET c = 2 * ATAN2( SQRT( a ), SQRT( 1 - a ) );
          SET dist = r * c;
          RETURN dist;
          END;
         "
       );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::unprepared('DROP FUNCTION IF EXISTS DISTANCE;');
    }
}
