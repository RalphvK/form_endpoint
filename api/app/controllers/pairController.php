<?php

    class pairController {

        static public function pair($pairkey) {

            // get row for pairkey
            $stmt = DB::conn()->prepare("SELECT * FROM api where pairkey = ?");
            $stmt->execute([$pairkey]);
            $result = $stmt->fetch();
            // if key is found
            if ($result) {
                // if key has activations left
                if ($result['activations'] > 0) {
                    // save new activations value in DB
                    $stmt = DB::conn()->prepare("UPDATE api SET activations=? WHERE id=?");
                    if ($stmt->execute([ (int)$result['activations']-1 , $result['id']])) {
                        $result['activations']--;
                    }
                    // set token cookie
                    setcookie("api_key",$result['token'],time()+31556926 ,'/');// where 31556926 is total seconds for a year.
                    // return data
                    return json_file($result, 'success');
                } else {
                    // return error
                    return json_file([
                        'error' => 'pairkey_unavailable',
                        'error_message' => 'This key cannot be used to connect to the api.'
                    ], 'error');
                }
            } else {
                // return error
                return json_file([
                    'error' => 'pairkey_notfound',
                    'error_message' => 'This is not a valid key.',
                    'key' => $pairkey
                ], 'error');
            }
        }

        static public function unpair() {
            // unset cookie
            if (isset($_COOKIE["api_key"])) {
                unset($_COOKIE["api_key"]);
                setcookie("api_key", '', time() - 3600, '/'); // empty value and old timestamp
            }
            // return success
            return json_file();
        }

    }