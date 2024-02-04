<?php

use Dompdf\Dompdf;

class Pdf extends Dompdf
{
    public $FileName;
    public $title;
    public $author;
    public $keywords;
    public $ContentType;

    public function SetFileName($file)
    {
        $this->FileName = $file;
        return $this;
    }

    public function ViewPrint($view, $data = array())
    {
        try {
            $html = "<html> <head>{$this->title}{$this->author}{$this->keywords}{$this->ContentType}</head>";
            $html .= $view . "</html>";
            $this->load_html($html);
            // Render the PDF
            $this->render();
            // Output the generated PDF to Browser
            $this->stream($this->FileName, array("Attachment" => false));
        } catch (Throwable $error) {
            throw new Exception($error->getMessage() . ' Line : ' . $error->getLine());
        }
    }

    public function SetTitle($title)
    {
        $this->title = "<title>{$title}</title>";
        return $this;
    }

    public function SetAuthor($author)
    {
        $this->author = "<meta name='author' content='{$author}'>";
        return $this;
    }

    public function SetKeyword($keywords)
    {
        $this->keywords = "<meta name='keywords' content='{$keywords}'>";
        return $this;
    }

    public function SetContentType($text)
    {
        $this->ContentType = "<meta http-equiv='Content-Type' content='{$text}' />";
        return $this;
    }
}
