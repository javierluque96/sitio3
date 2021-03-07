<?php
/**
 * @author Javier Luque Rodríguez
 */
require_once 'LibrarianDB.php';
/**
 * Book
 * 
 * @implements JsonSerializable
 */
class Book implements JsonSerializable
{
    private ?int $id_book;
    private string $title;
    private int $pages;
    private string $ISBN;
    private bool $borrowed;
    private string $genre;

    public function __construct($id_book, $title, $pages, $ISBN, $borrowed, $genre)
    {
        $this->id_book = $id_book;
        $this->title = $title;
        $this->pages = $pages;
        $this->ISBN = $ISBN;
        $this->borrowed = $borrowed;
        $this->genre = $genre;
    }
    
    /**
     * Insert a Book to the database
     *
     * @return void
     */
    public function insert()
    {
        $conn = LibrarianDB::getConnection();
        $conn->prepare(
            "INSERT INTO book (id_book, title, pages, ISBN, borrowed, 
                genre) VALUES (?, ?, ?, ?, ?, ?, ?, ?)",
            [$this->id_book, $this->title, $this->pages, $this->ISBN,
             $this->borrowed, $this->genre]
        );
    }
    
    /**
     * Delete a book from database
     *
     * @return void
     */
    public function delete(): void
    {
        $conn = LibrarianDB::getConnection();
        $conn->prepare("DELETE FROM book WHERE id_book=?", [$this->id]);
    }
    
    /**
     * Update a book from database
     *
     * @return void
     */
    public function update(): void
    {
        $conn = LibrarianDB::getConnection();
        $conn->prepare(
            "UPDATE book SET title=?, pages=?, ISBN=?, borrowed=?, genre=? 
             WHERE id_book=?",
            [$this->title, $this->pages, $this->ISBN, $this->borrowed, $this->genre,
            $this->id_book]
        );
    }
 
    /**
     * Get a book from the database by id
     * @param int $id
     * @return Book|null
     */
    public static function getBookById(int $id): ?Book
    {
        $conn = LibrarianDB::getConnection();
        $result = $conn->prepare("SELECT * FROM book WHERE id_book=?", [$id]);
        $reg = $result->fetchObject();

        if ($reg) {
            return new Book(
                $reg->id_book,
                $reg->title,
                $reg->pages,
                $reg->ISBN,
                $reg->borrowed,
                $reg->genre
            );
        }

        return null;
    }
        
    /**
     * Get all books from database
     *
     * @return array
     */
    public static function getBooks(): array
    {
        $conn = LibrarianDB::getConnection();
        $result = $conn->prepare("SELECT * FROM book");
        $books = [];
        while ($reg = $result->fetchObject()) {
            $books[] = new Book(
                $reg->id_book,
                $reg->title,
                $reg->pages,
                $reg->ISBN,
                $reg->borrowed,
                $reg->genre
            );
        }

        return $books;
    }


    public function jsonSerialize(): array {
        return [
            "id_book" => $this->id_book,
            "title" => $this->title,
            "pages" => $this->pages,
            "ISBN" => $this->ISBN,
            "borrowed" => $this->borrowed,
            "genre" => $this->genre
        ];
    }

    /**
     * Get the value of id_book
     * 
     * @return int|null
     */
    public function getId_book(): ?int
    {
        return $this->id_book;
    }

    /**
     * Set the value of id_book
     */
    public function setId_book($id_book)
    {
        $this->id_book = $id_book;
    }

    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     * 
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get the value of pages
     * 
     * @return int
     */
    public function getPages(): int
    {
        return $this->pages;
    }

    /**
     * Set the value of pages
     * 
     * @return void
     */
    public function setPages($pages)
    {
        $this->pages = $pages;
    }

    /**
     * Get the value of ISBN
     * 
     * @return string
     */
    public function getISBN(): string
    {
        return $this->ISBN;
    }

    /**
     * Set the value of ISBN
     * 
     * @param type $ISBN
     * @return void
     */
    public function setISBN($ISBN): void
    {
        $this->ISBN = $ISBN;
    }

    /**
     * Get the value of borrowed
     * 
     * @return bool
     */
    public function getBorrowed(): bool
    {
        return $this->borrowed;
    }

    /**
     * Set the value of borrowed
     * 
     * @param bool $borrowed
     * @return void
     */
    public function setBorrowed($borrowed): void
    {
        $this->borrowed = $borrowed;
    }

    /**
     * Get the value of genre
     * 
     * @return string
     */
    public function getGenre(): string
    {
        return $this->genre;
    }

    /**
     * Set the value of genre
     * 
     * @param string $genre
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;
    }
}
