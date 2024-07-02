<?php
class Helper {
    // START SERVER SITE DATA LOADING
    //Pagination
    public static function paginate($data=[], $perPage=10) {
        $perPage = (empty($data) || empty($data['perPage'])) ? $perPage : $data['perPage'];
        $serial = (!empty($data) && !empty($data['page']) && ($data['page']>1)) ? ($perPage*($data['page']-1))+1 : 1;
        return (object) ['perPage' => $perPage, 'serial' => $serial];
    }
    // END SERVER SITE DATA LOADING

    // GET ROLE NAME BY ROLE ID
    public static function roleName($id)
    {
        return DB::table('roles')->find($id)->name;
    }
    // GET LOCATION NAME BY LOCATION ID
    public static function locationeName($id)
    {
        return DB::table('locations')->find($id)->name_en;
    }
}
