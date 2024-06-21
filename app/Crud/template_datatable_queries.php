if(Session::has('%FIELD%') && Session::get('%FIELD%')){
    $query->where('%FIELD%', Session::get('%FIELD%'));
}
