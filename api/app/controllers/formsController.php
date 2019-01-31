<?php

    class formsController {

        static public function getRules($public_id) {
            $stmt = DB::conn()->prepare("SELECT validation_rules FROM forms WHERE public_id = ?");
            $stmt->execute([$public_id]);
            $result = $stmt->fetch();
            if ($result) {
                return json_decode($result['validation_rules'], true); // decode to array
            } else {
                return false;
            }
        }

        static public function insert($validation_rules) {
            // insert function
            $insert = function($stmt) use ($validation_rules) {
                try {
                    // generate public id
                    $public_id = generate::form_id();
                    $stmt->execute([
                        'public_id' => $public_id,
                        'validation_rules' => json_encode($validation_rules)
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
            $stmt = DB::conn()->prepare('INSERT INTO forms (public_id, validation_rules) VALUES (:public_id, :validation_rules)');
            
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