<?php 

class FileStorage extends Storage 
{
    public function create($text)
    {
        $i = 1;
        $fileName = $text->slug ."_". date("d.m.Y H:m");
        while(file_exists($fileName)) {       
            $fileName = $text->slug ."_". date("d.m.Y") . '_' . $i;
            $i++;
        }
        $text->slug = $fileName;
        file_put_contents($fileName, serialize($text));
        return $fileName;
    }

    public function read($slug)
    { 
        return unserialize(file_get_contents($slug));      
    }

    public function update($slug)
    {
        if (scandir($slug)) {
            $slug = unserialize(file_get_contents($slug));
        }
    }

    public function delete($slug)
    {
        if (file_exists($slug)) {
            unlink($slug);
        }
    }

    public function list($file)
    {
        $texts = [];
        $files = scandir($file);
        foreach ($files as $file) {
            $data = file_get_contents($files);
            $texts[] = unserialize(file_get_contents($data));
        }
        return $texts;
    }

    public function lastMessages($num)
    {
        return $num;
    }

    public function logMessage($stringError)
    {
        $this->logs[] = $stringError;
        // print_r($this->logs);
        file_put_contents($this->slug, serialize($this->logs));
    }

    public function attachEvent ($method)
    {
        call_user_func("method");
    }

    public function detouchEvent ($method)
    {
        call_user_func("method");

    }
    
}