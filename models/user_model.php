<?php
//user_model

class User_Model extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Add a new user
     * @param string $attribute the table field we want to list
     */
    public function create($data)
    {
        //Inserting data from form in the database 
        $this->db->insert(
            'user',
            [
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'login' => $data['login'],
                'email' => $data['email'],
                'phonenumber' => $data['phonenumber'],
                'adress' => $data['adress'],
                'password' => Hash::create(_HASH_ALGORITHM_, $data['password'], _HASH_PASSWORD_KEY_)
            ]
        );
        //Redirect to the view that sent the request to avoid data duplication on error
        header('location:' . _URL_ . 'user');
    }
    public function showUserList()
    {
        return $this->db->select("SELECT * FROM user");
    }

    public function showSingleList($id)
    {
        return $this->db->select("SELECT * FROM user WHERE iduser= :id", array(":id" => $id));
    }

    /**
     * editUser - Saves the data edition to the database
     * @param array $data values to save to database
     */
    public function editUser($data)
    {
        $this->db->update(
            "user",
            [
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'login' => $data['login'],
                'email' => $data['email'],
                'phonenumber' => $data['phonenumber'],
                'adress' => $data['adress'],
                'password' => Hash::create('sha384', $data['password'], _HASH_PASSWORD_KEY_)
            ],
            "`iduser` = {$data['iduser']}"
        );
    }

    /**
     * deleteUser -
     * @param Integer $id
     * @return boolean
     */
    public function deleteUser($id)
    {
        $result = $this->db->select("SELECT * FROM user WHERE iduser= :id", array(":id" => $id));
        $this->db->delete("user", "iduser= '$id'");
    }

    /**
     * countCategories
     * @return Integer
     */
    public function countUser()
    {
        return (int) $this->db->count_rows("user")[0][0];
    }

    /**
     * findUserByLogin
     * @return boolean
     * 
     */

    public function findUserByLogin($login, $password)
    {
        $password_hash = Hash::create(_HASH_ALGORITHM_, $password, _HASH_PASSWORD_KEY_);
        $user = $this->db->select(
            "SELECT * FROM user WHERE login= :login AND password = :password",
            array(":login" => $login, ":password" => $password_hash)
        );

        if ($user) {
            return $user[0]['login'] == $login;
        } else {
            return false;
        }
    }
}
