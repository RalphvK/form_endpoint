<?php

    class scanController {

        public static function getIdField($params) {
            $output = new stdClass();
            if (isset($params->serial)) {
                $output->field = 'serial';
                $output->value = $params->serial;
                return $output;
            } else if (isset($params->token)) {
                $output->field = 'token';
                $output->value = $params->token;
                return $output;
            } else {
                return false;
            }
        }

        public static function getCustomer($id) {
            // get customer from database
            $stmt = DB::conn()->prepare("SELECT * FROM customers WHERE id = ?");
            $stmt->execute([$id]);
            $result = $stmt->fetch();
            // if customer is found
            if ($result) {
                return $result;
            } else {
                return false;
            }
        }

        /*
        scan method
        $identifier (string): ticket serial number, as scanned by the scanner
        $joinCustomer (bool): fetches customer record if TRUE, set to FALSE for best performance
        $setScanned (bool): if TRUE, the ticket will be marked as "scanned" in the database
        */
        public static function scan($identifier, $joinCustomer = true, $setScanned = true, $field = 'serial') {
            // get ticket from database
            if ($field == 'token') {
                $stmt = DB::conn()->prepare("SELECT * FROM tickets WHERE token = ?");
            } else {
                $stmt = DB::conn()->prepare("SELECT * FROM tickets WHERE serial = ?");
            }
            $stmt->execute([$identifier]);
            $result = $stmt->fetch();
            // if ticket is found
            if ($result) {
                // join customer record
                if ($joinCustomer) {
                    $result['customer'] = self::getCustomer($result['customer']);
                }
                // if key is valid AND unscanned AND should be set to scanned
                if ($result['isValid'] == 1 && $result['scanned'] == 0 && $setScanned) {
                    // set scanned to 1
                    $stmt = DB::conn()->prepare("UPDATE tickets SET scanned=? WHERE id=?");
                    if ($stmt->execute([1, $result['id']])) {
                        // report back to front-end the scan was registered
                        $scanned = true;
                    } else {
                        // report to front-end that the scan was NOT registered due to an error
                        $result['error'] = 'unable_to_set_scanned';
                        $result['error_message'] = 'This ticket could not be set to "scanned" due to an unknown error. Please alert support staff.';
                        // return json
                        return json_file($result, 'error', [
                            'setScanned' => false,
                            'joinCustomer' => $joinCustomer
                        ]);
                    }
                } else {
                    // report to front-end that the scan was NOT registered
                    $scanned = false;
                }
                // return json
                return json_file($result, 'success', [
                    'setScanned' => $scanned,
                    'joinCustomer' => $joinCustomer
                ]);
            } else {
                // else return error
                return json_file([
                    'error' => 'ticket_not_found',
                    'error_message' => 'This ticket could not be found in the database.',
                    'serial' => htmlspecialchars($identifier)
                ], 'error');
            }
        }

        public static function unscan($identifier, $field = 'serial') {
             // set scanned to 0
             if ($field == 'token') {
                $stmt = DB::conn()->prepare("UPDATE tickets SET scanned=? WHERE token=?");
             } else {
                $stmt = DB::conn()->prepare("UPDATE tickets SET scanned=? WHERE serial=?");
             }
             if ($stmt->execute([0 , $identifier])) {
                return true;
             } else {
                // return error
                return json_file([
                    'error' => 'unscan_error',
                    'error_message' => 'Tickets could not be set as not-scanned.'
                ], 'error');
             }
        }

    }