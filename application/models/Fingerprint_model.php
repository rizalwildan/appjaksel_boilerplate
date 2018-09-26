<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: rizal
 * Date: 9/26/2018
 * Time: 10:54 PM
 */

class Fingerprint_model extends yidas\Model
{
    protected $table = 'mesin_fingerprint';
    protected $primaryKey = 'id_fingerprint';
    protected $timestamps = FALSE;
}