<?php

    class formsController {

        static public function rules($public_id) {
            $stmt = DB::conn()->prepare("SELECT validation_rules, whitelist FROM forms WHERE public_id = ?");
            $stmt->execute([$public_id]);
            $result = $stmt->fetch();
            if ($result) {
                // set CORS headers
                CORS::setHeaders($result['whitelist']);
                // return validation rules
                return json_decode($result['validation_rules'], true); // decode to array
            } else {
                return false;
            }
        }

        static public function insert($fields = []) {
            $defaults = ["validation_rules" => [], "whitelist" => ""];
            $fields = array_merge($defaults, $fields);
            // insert function
            $insert = function($stmt) use ($fields) {
                try {
                    // generate public id
                    $public_id = generate::form_id();
                    $stmt->execute([
                        'public_id' => $public_id,
                        'validation_rules' => json_encode($fields['validation_rules']),
                        'whitelist' => $fields['whitelist']
                    ]);
                } catch (PDOException $e) {
                    // key constraint (duplicate)
                    if ($e->getCode() == 1062) {
                        // try again
                        return 'duplicate';
                    } else {
                        throw $e;
                        return false;
                    }
                }
                return $public_id;
            };

            // prepare query
            $stmt = DB::conn()->prepare('INSERT INTO forms (public_id, validation_rules, whitelist) VALUES (:public_id, :validation_rules, :whitelist)');
            
            // run insert
            $attemptInsert = true;
            while($attemptInsert) {
                $result = $insert($stmt);
                if ($result == 'duplicate') {
                    $attemptInsert = true; // try again
                } else if (is_string($result)) {
                    $attemptInsert = false; // stop loop
                    return $result; // return id
                } else {
                    $attemptInsert = false; // stop loop
                    return false; // return false
                }
            }
            
        }

    }

?>