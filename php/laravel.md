DB::connection()->enableQueryLog();

$queries    = DB::getQueryLog();
$last_query = end($queries);