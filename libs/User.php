<?php

/**
 * @author Javier Luque Rodríguez
 */
require_once 'LibrarianDB.php';

/**
 * User
 * 
 * @implements JsonSerializable
 */
class User implements JsonSerializable {

    private ?int $id;
    private string $name;
    private string $surname;
    private string $user_type;
    private string $email;
    private string $password;
    private string $address;
    private string $phone;
    private ?string $api_key;

    public function __construct($id, $name, $surname, $user_type, $email, $password, $address, $phone, $api_key = null) {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->user_type = $user_type;
        $this->email = $email;
        $this->password = $password;
        $this->address = $address;
        $this->phone = $phone;
        $this->api_key = $api_key;
    }

    /**
     * Insert a user to the database
     * 
     * @return void
     */
    public function insert(): void {
        $conn = LibrarianDB::getConnection();
        $conn->prepare(
                "INSERT INTO user (name_user, surname_user, user_type, email, password, address, 
                phone) VALUES (?, ?, ?, ?, ?, ?, ?)",
                [$this->name, $this->surname, $this->user_type, $this->email,
                    password_hash($this->password, PASSWORD_DEFAULT), $this->address, $this->phone]
        );
    }

    /**
     * Delete a user from the database
     * 
     * @return void
     */
    public function delete(): void {
        $conn = LibrarianDB::getConnection();
        $conn->prepare("DELETE FROM user WHERE id_user=?", [$this->id]);
    }

    /**
     * Update a user from database
     * 
     * @return void
     */
    public function update(): void {
        $conn = LibrarianDB::getConnection();
        $conn->prepare(
                "UPDATE user SET name_user=?, surname_user=?, user_type=?, email=?, password=?, address=?, phone=? 
             WHERE id_user=?",
                [$this->name, $this->surname, $this->user_type, $this->email, $this->password,
                    $this->address, $this->phone, $this->id]
        );
    }

    /**
     * Get all users from the database
     * 
     * @return array
     */
    public static function getUsers(): array {
        $conn = LibrarianDB::getConnection();
        $users_selected = "SELECT id_user, name_user, surname_user, email, password, phone, address, user_type, api_key FROM user";
        $query = $conn->query($users_selected);

        $users = [];

        while ($reg = $query->fetchObject()) {
            $users[] = new User(
                    $reg->id_user,
                    $reg->name_user,
                    $reg->surname_user,
                    $reg->user_type,
                    $reg->email,
                    $reg->password,
                    $reg->address,
                    $reg->phone,
                    $reg->api_key
            );
        }

        return $users;
    }

    /**
     * Get one user from database by id (primary key)
     * 
     * @param int $id user id in the database
     * @return User|null
     */
    public static function getUserById(int $id): ?User {
        $conn = LibrarianDB::getConnection();
        $query = $conn->prepare("SELECT id_user, name_user, surname_user, email, password, phone, address, user_type, api_key 
                                 FROM user WHERE id_user=?", [$id]);
        $reg = $query->fetchObject();
        $user = null;

        if ($reg) {
            $user = new User(
                    $reg->id_user,
                    $reg->name_user,
                    $reg->surname_user,
                    $reg->user_type,
                    $reg->email,
                    $reg->password,
                    $reg->address,
                    $reg->phone,
                    $reg->api_key
            );
        }

        return $user;
    }

    /**
     * Get a user from database by email
     * 
     * @param string $email
     * @return User|null
     */
    public static function getUserByEmail(string $email): ?User {
        $conn = LibrarianDB::getConnection();
        $users_selected = "SELECT id_user, name_user, surname_user, email, password, phone, address, user_type, api_key 
                           FROM user WHERE email='$email'";
        $query = $conn->query($users_selected);
        $reg = $query->fetchObject();
        $user = null;

        if ($reg) {
            $user = new User(
                    $reg->id_user,
                    $reg->name_user,
                    $reg->surname_user,
                    $reg->user_type,
                    $reg->email,
                    $reg->password,
                    $reg->address,
                    $reg->phone,
                    $reg->api_key
            );
        }

        return $user;
    }

    /**
     * Checks that the email and password are in the database to sign in.
     * 
     * @param email             String
     * @param password          String
     * @return
     */
    public static function checkLogin(string $email, string $password): bool {
        $users = self::getUsers();

        foreach ($users as $user) {
            if ($email == $user->getEmail() && password_verify($password, $user->getPassword())) {
                return true;
            }
        }
        return false;
    }

    /**
     * Checks if the api key is stored in database
     *
     * @param  string $key
     * @return bool
     */
    public static function checkApi(string $key): bool {
        $conn = LibrarianDB::getConnection();
        $result = $conn->prepare("SELECT * FROM user WHERE api_key=?", [$key]);
        return $result->fetchObject() != null;
    }

    /**
     * Checks that the email is not being used by other user.
     * @param email             String
     * @return                  true if available, false if not available
     */
    public static function emailAvailable(string $mail): bool {
        $users = self::getUsers();

        foreach ($users as $user) {
            if ($mail == $user->getEmail()) {
                return false;
            }
        }

        return true;
    }

    public function jsonSerialize() {
        return array(
            "id_user" => $this->id,
            "name_user" => $this->name,
            "surname_user" => $this->surname,
            "user_type" => $this->user_type,
            "email" => $this->email,
            "password" => $this->password,
            "address" => $this->address,
            "phone" => $this->phone,
            "api_key" => $this->api_key
        );
    }

    /**
     * Set the value of api_key
     *
     * @return  self
     */
    public function generateApi_key() {
        $conn = LibrarianDB::getConnection();
        $this->api_key = md5(time() . $this->email);

        $conn->prepare("UPDATE user SET api_key=? WHERE id_user=?", [$this->api_key, $this->id]);
    }

    /**
     * getId
     *
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * getName
     *
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * getSurname
     *
     * @return string
     */
    public function getSurname(): string {
        return $this->surname;
    }

    /**
     * getEmail
     *
     * @return string
     */
    public function getEmail(): string {
        return $this->email;
    }

    /**
     * getPassword
     *
     * @return string
     */
    public function getPassword(): string {
        return $this->password;
    }

    /**
     * getAddress
     *
     * @return string
     */
    public function getAddress(): string {
        return $this->address;
    }

    /**
     * getPhone
     *
     * @return string
     */
    public function getPhone(): string {
        return $this->phone;
    }

    /**
     * getUserType
     *
     * @return string
     */
    public function getUserType(): string {
        return $this->user_type;
    }

    /**
     * getUserTypeString
     *
     * @return string
     */
    public function getUserTypeString(): string {
        switch ($this->user_type) {
            case 1:
                return "admin";
                break;
            case 10:
                return "librarian";
                break;
            case 20:
                return "student";
                break;
            default:
                return null;
        }
    }

    /**
     * Get the value of api_key
     * @return string
     */
    public function getApi_key(): string {
        return $this->api_key ?? "";
    }

}
