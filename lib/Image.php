<?php
/**
 * Klasa ułatwiająca wykonywanie różnych operacji na obrazach
 *
 * @author Rafał Kukawski
 * @license http://kukawski.pl/mit-license.txt MIT License
 *
 * @property-read int $width Szerokość obrazu
 * @property-read int $height Wysokość obrazu
 * @property-read resource $rawImage Zasób obrazu
 */
class Image {
    /**
     * Wymiary przeskalowanego obrazu zostaną przyjęte dokładnie takie
     * jakie przekażemy do metody scale
     * 
     * @final
     * @static
     * @see Image::scale()
     */
    const PROP_NONE = 0;
    
    /**
     * Wysokość przeskalowanego obrazu będzie proporcjonalna do jego szerokości
     * 
     * @final
     * @static
     * @see Image::scale()
     */
    const PROP_HEIGHT = 1;
    
    /**
     * Szerokość przeskalowanego obrazu będzie proporcjonalna do jego wysokości
     * 
     * @final
     * @static
     * @see Image::scale()
     */
    const PROP_WIDTH = 2;
    
    /**
     * Krótsza krawędź przeskalowanego obrazu będzie proporcjonalna do dłuższej krawędzi
     * 
     * @final
     * @static
     * @see Image::scale()
     */
    const PROP_SHRINK = 3;
    
    /**
     * Dłuższa krawędź przeskalowanego obrazu będzie proporcjonalna do krótszej krawędzi
     * 
     * @final
     * @static
     * @see Image::scale()
     */
    const PROP_GROW = 4;
    
    /**
     * Obraz zostanie przeskalowany, żeby w całości zmieścić się w podanych wymiarach.
     * Wolna przestrzeń będzie przezroczysta
     * 
     * @final
     * @static
     * @see Image::scale()
     */
    const PROP_FIT = 5;
    
    /**
     * Obraz zostanie przeskalowany, żeby zapełnić cały obszar o podanych wymiarach.
     * Nadmiar obrazu zostanie przycięty z obydwu stron (góra-dół lub lewo-prawo) równomiernie
     * 
     * @final
     * @static
     * @see Image::scale()
     */
    const PROP_CROP = 6;
    
    /**
     * Kadrując obraz, wartość ta oznacza, że w kadrze ma znaleźć się dolna krawędź obrazu.
     * W operacji wklejania, wartość ta oznacza, że chcemy wkleić obraz wyrównany do dolnej krawędzi
     *
     * @final
     * @static
     * @see Image::crop()
     * @see Image::merge()
     */
    const BOTTOM = 32;
    
    /**
     * Kadrując obraz, wartość ta oznacza, że w kadrze ma znaleźć się górna krawędź obrazu.
     * W operacji wklejania, wartość ta oznacza, że chcemy wkleić obraz wyrównany do górnej krawędzi
     *
     * @final
     * @static
     * @see Image::crop()
     * @see Image::merge()
     */
    const TOP = 16;
    
    /**
     * Kadrując obraz, wartość ta oznacza, że w kadrze ma znaleźć się prawa krawędź obrazu.
     * W operacji wklejania, wartość ta oznacza, że chcemy wkleić obraz wyrównany do prawej krawędzi
     *
     * @final
     * @static
     * @see Image::crop()
     * @see Image::merge()
     */
    const RIGHT = 8;
    
    /**
     * Kadrując obraz, wartość ta oznacza, że w kadrze ma znaleźć się dolna lewa obrazu.
     * W operacji wklejania, wartość ta oznacza, że chcemy wkleić obraz wyrównany do lewej krawędzi
     *
     * @final
     * @static
     * @see Image::crop()
     * @see Image::merge()
     */
    const LEFT = 4;
    
    /**
     * Kadrując obraz, wartość ta oznacza, że w kadrze ma znaleźć się środek obrazu.
     * W operacji wklejania, wartość ta oznacza, że chcemy wkleić obraz wyrównany do środka w pionie
     *
     * @final
     * @static
     * @see Image::crop()
     * @see Image::merge()
     */
    const VCENTER = 2;
    
    /**
     * Kadrując obraz, wartość ta oznacza, że w kadrze ma znaleźć się środek obrazu.
     * W operacji wklejania, wartość ta oznacza, że chcemy wkleić obraz wyrównany do środka w poziomie
     *
     * @final
     * @static
     * @see Image::crop()
     * @see Image::merge()
     */
    const HCENTER = 1; 
    
    /**
     * Zasób obrazu, na którym będziemy wykonywać operacje
     * @access protected
     * @var resource
     */
    protected $source;

    /**
     * Konstruktor klasy.
     * @constructor
     * @param string|resource $source Ścieżka do pliku z obrazem
     *     lub zasób reprezentujący obraz
     * @access public
     */
    public function __construct ($source) {
        $image = $this->loadImage($source);

        if ($image) {
            $this->source = $image;
        } else {
            throw new InvalidArgumentException('Podane źródło nie jest obsługiwanym typem graficznym');
        }
    }
    
    /**
     * Sprawdza, czy podany parametr jest zasobem zdjęcia obsługiwanym przez GD
     *
     * @param resource $source Źródło pliku graficznego
     * @returns {bool} Prawda, jeśli jest to zasób obsługiwany przez GD
     * @static
     */
    static function isImageResource ($source) {
        return is_resource($source) && imagesx($source) !== false;
    }

    /**
     * Próbuje ustalić typ obrazu dostępny pod podaną ścieżką.
     * Jeśli pod ścieżką jest obraz rozpoznawany przez GD
     * zwrócony zostanie jego typ, w przeciwnym wypadku -1
     *
     * @param string $source Źródło pliku graficznego
     * @returns int Typ obrazu zgodny ze stałymi IMAGETYPE_XXX
     * @static
     */
    static function getImageType ($source) {
        $type = -1;

        if (is_string($source)) {
            $imageData = getimagesize($source);
           
            if ($imageData) {
                $type = $imageData[2];
            }
        }
        return $type;
    }
    
    /**
     * Zwraca zasób obrazu z podanego źródła
     *
     * @param string|resource $source Źródło obrazu
     * @return resource Zasób obrazu lub null, gdy nie udało się wczytać obrazu
     * @access protected
     */
    protected function loadImage ($source) {
        $image = null;
        $type = -1;

        if (self::isImageResource($source)) {
            $image = $source;
        } else {
            $type = self::getImageType($source);

            if ($type !== -1) {
                $image = imagecreatefromstring(file_get_contents($source));
            }
        }

        return $image;
    }
    
    /**
     * Skaluje obraz do podanych rozmiarów używając opcjonalnych proporcji
     *
     * @param int $newWidth Szerokość obrazu wynikowego
     * @param int $newHeight Wysokość obrazu wynikowego
     * @param int $proportions Opcjonalne dane na temat metody skalowania
     * @return Image Nowy, przeskalowany obraz
     * @access public
     */
    public function scale ($newWidth, $newHeight, $proportions = 0) {
        $width = $this->width; // cache’ujemy rozmiary obrazu, żeby zbyt często nie korzystać z gettera
        $height = $this->height;

        // Sprawdzamy, czy zdjęcie jest poziome
        $landscape = $width > $height;

        switch ($proportions) {
            case self::PROP_FIT:
                $scaled = $this->scale($newWidth, $newHeight, self::PROP_SHRINK);
                $tmp = new Image(Image::transparent($newWidth, $newHeight));
                
                return $tmp->merge($scaled, self::HCENTER | self::VCENTER);
            case self::PROP_CROP:
                $scaled = $this->scale($newWidth, $newHeight, self::PROP_GROW);
                return $scaled->crop($newWidth, $newHeight, self::HCENTER | self::VCENTER);
            case self::PROP_SHRINK:
                $scale = min($newWidth / $width, $newHeight / $height);
                
                $newWidth = round($width * $scale);
                $newHeight = round($height * $scale);
                return $this->scale($newWidth, $newHeight, Image::PROP_NONE);
            case self::PROP_GROW:
                $scale = max($newWidth / $width, $newHeight / $height);
                
                $newWidth = round($width * $scale);
                $newHeight = round($height * $scale);
                return $this->scale($newWidth, $newHeight, Image::PROP_NONE);
            case self::PROP_HEIGHT:
                $newHeight = round($newWidth * $height / $width);
                return $this->scale($newWidth, $newHeight, self::PROP_NONE);
            case self::PROP_WIDTH:
                $newWidth = round($newHeight * $width / $height);
                return $this->scale($newWidth, $newHeight, self::PROP_NONE);
            default:
                $newImage = Image::transparent($newWidth, $newHeight);
                imagecopyresampled($newImage, $this->source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

                return new Image($newImage);
        }
    }
    
    /**
     * Funkcja kadrująca obraz do podanych rozmiarów
     *
     * @param int $toWidth Szerokość po skadrowaniu
     * @param int $toHeight Wysokość po skadrowaniu
     * @param int $align Wyrównanie zdjęcia przed kadrowaniem.
     *     Wartości zdefiniowane jako stałe TOP, BOTTOM, VCENTER,
     *     LEFT, RIGHT, HCENTER.
     * @return Image Skadrowany obraz
     * @access public
     * @see Image::TOP
     * @see Image::BOTTOM
     * @see Image::VCENTER
     * @see Image::LEFT
     * @see Image::RIGHT
     * @see Image::HCENTER
     */
    public function crop ($toWidth, $toHeight, $align = 0) {
        $newImage = Image::transparent($toWidth, $toHeight);
        $width = $this->width;
        $height = $this->height;

        // Jeśli obraz węższy od kadru, przyjmujemy jego szerokość
        $toWidth = min($width, $toWidth);

        // Jeśli obraz niższy od kadru, przyjmujemy jego wysokość
        $toHeight = min($height, $toHeight);

        $x = 0; $y = 0;

        if (0 !== ($align & self::RIGHT)) {
            $x = $width - $toWidth;
        } else if (0 !== ($align & self::HCENTER)) {
            $x = floor(($width - $toWidth) / 2);
        }

        if (0 !== ($align & self::BOTTOM)) {
            $y = $height - $toHeight;
        } else if (0 !== ($align & self::VCENTER)) {
            $y = floor(($height - $toHeight) / 2);
        }

        imagecopy($newImage, $this->source, 0, 0, $x, $y, $toWidth, $toHeight);

        return new Image($newImage);
    }
    
    /**
     * Funkcja wklejająca obraz do drugiego
     *
     * @param Image|resource $image Obraz do wklejenia
     * @param int $align Wyrównanie wklejonego obrazu
     * @param int $hmargin Odsunięcie wklejanego obrazu od lewej lub prawej krawędzi obrazu docelowego
     * @param int $vmargin Odsunięcie wklejanego obrazu od górnej lub dolnej krawędzi obrazu docelowego
     * @return Image Obraz powstały z wklejenia jednego obrazu do drugiego
     * @access public
     *
     * @see Image::TOP
     * @see Image::BOTTOM
     * @see Image::VCENTER
     * @see Image::LEFT
     * @see Image::RIGHT
     * @see Image::HCENTER
     */
    public function merge ($image, $align = 0, $hmargin = 0, $vmargin = 0) {
        if (self::isImageResource($image)) {
            $image = new Image($image);
        } else if (!($image instanceOf Image)) {
            throw new InvalidArgumentException('Oczekiwano instancji klasy Image lub zasobu z obrazem');
        }

        $width = $this->width;
        $height = $this->height;

        $imageWidth = $image->width;
        $imageHeight = $image->height;

        $x = $hmargin; $y = $vmargin;

        if (0 !== ($align & self::RIGHT)) {
            $x = $width - $imageWidth - $hmargin;
        } else if (0 !== ($align & self::HCENTER)) {
            $x = round(($width - $imageWidth) / 2);
        }

        if (0 !== ($align & self::BOTTOM)) {
            $y = $height - $imageHeight - $vmargin;
        } else if (0 !== ($align & self::VCENTER)) {
            $y = round(($height - $imageHeight) / 2);
        }

        $newImage = Image::transparent($width, $height);
        imagecopy($newImage, $this->source, 0, 0, 0, 0, $width, $height);
        imagecopy($newImage, $image->rawImage, $x, $y, 0, 0, $imageWidth, $imageHeight);

        return new Image($newImage);
    }
    
    public function __get ($prop) {
        switch ($prop) {
            case 'width':
                return imagesx($this->source);
            case 'height':
                return imagesy($this->source);
            case 'rawImage':
                return $this->source;
        }
        return null;
    }
    
    /**
     * Tworzy przezroczysty obraz o podanych rozmiarach
     *
     * @param int $width Szerokość nowego obrazu
     * @param int $height Wysokość nowego obrazu
     * @return resource Zasób przezroczystego obrazu
     * @static
     * @access protected
     */
    protected static function transparent ($width, $height) {
        $image = imagecreatetruecolor($width, $height);
        imagealphablending($image, false);
        imagesavealpha($image, true);
        $color = imagecolortransparent($image, imagecolorallocatealpha($image, 0, 0, 0, 127));
        imagefill($image, 0, 0, $color);
        
        return $image;
    }
    
    /**
     * Zapisuje obraz do pliku w formacie PNG
     *
     * @param string $dest Ścieżka pod którą zapisać obraz
     * @param int $compression Stopień kompresji obrazu (0-9)
     * @param int $filters Filtry redukujące wielkość wynikowego pliku
     * @access public
     * @link http://php.net/imagepng
     */
    public function toPNG ($dest, $compression = 0, $filters = PNG_NO_FILTER) {
        return imagepng($this->source, $dest, $compression, $filters);
    }

    /**
     * Zapisuje obraz do pliku w formacie JPG
     *
     * @param string $dest Ścieżka pod którą zapisać obraz
     * @param $quality Jakość zapisywanego obrazu
     * @access public
     * @link http://php.net/imagejpeg
     */
    public function toJPG ($dest, $quality = 75) {
        return imagejpeg($this->source, $dest, $quality);
    }
}
?>