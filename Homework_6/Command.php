<?php
abstract class Command
{
    public abstract function execute();
    public abstract function unExecute();
}

class EditorCommand extends Command
{
    public $operator;
    public $beginText;
    public $endText;
    public $buffer;
    public $textEditor;

    public function __construct(TextEditor $textEditor, $operator, $buffer, $beginText, $endText)
    {
        $this->beginText = $beginText;
        $this->endText = $endText;
        $this->operator = $operator;
        $this->buffer = $buffer;
        $this->textEditor = $textEditor;
    }

    public function execute()
    {
        switch ($this->operator)
        {
            case 'copy' :
                $this->buffer = $this->textEditor->copyText($this->beginText, $this->endText);
                return $this->buffer;

            case 'cut' :
                $this->buffer = $this->textEditor->cutText($this->beginText, $this->endText);
                return $this->buffer;

            case 'insert' :
                $this->textEditor->insertText($this->beginText, $this->buffer);
                $this->endText = $this->beginText + mb_strlen($this->buffer);
                return $this->buffer;
        }
    }

    public function unExecute()
    {
        switch ($this->operator)
        {
            case 'copy' :
                break;

            case 'cut' :
                $this->textEditor->insertText($this->beginText, $this->buffer);
                break;

            case 'insert' :
                $this->textEditor->cutText($this->beginText, $this->endText);
                break;
        }
    }
}

class MacrosoftWorld
{
    private $textEditor;
    private $commands = [];
    private $current = 0;
    public $buffer = '';

    public function __construct($text)
    {
        $this->textEditor = new TextEditor($text);
    }

    public function runCommand($operator, $beginText, $endText)
    {
        $command = new EditorCommand($this->textEditor, $operator, $this->buffer, $beginText, $endText);
        $this->buffer = $command->execute();

        $this->commands[] = $command;
        $this->current++;
    }

    public function down($levels)
    {
        for ($i = 0; $i < $levels; $i++)
        {
            if($this->current > 0){
                $this->commands[--$this->current]->unExecute();
            }
        }
    }

    public function up($levels)
    {
        for ($i = 0; $i < $levels; $i++)
        {
            if($this->current < count($this->commands)){
                $this->commands[$this->current++]->execute();
            }
        }
    }

    public function getText()
    {
        $this->textEditor->getText();
    }

}

class TextEditor
{
    private $text;

    public function __construct($text)
    {
        $this->text = $text;
    }

    public function insertText($beginText, $boofer)
    {
        $text = $this->text;
        $this->text = mb_substr($text, 0, $beginText) . $boofer . mb_substr($text, $beginText);
    }

    public function cutText($beginText, $endText)
    {
        $text = $this->text;
        $this->text = mb_substr($text, 0, $beginText) . mb_substr($text, $endText);
        return mb_substr($text, $beginText, $endText - $beginText);
    }

    public function copyText($beginText, $endText)
    {
        return mb_substr($this->text, $beginText, $endText - $beginText);
    }

    public function getText()
    {
        echo $this->text;
    }

}require "Command.php";
require "EditorCommand.php";
require "MacrosoftWorld.php";
require "TextEditor.php";

$text =
    'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab accusantium adipisci asperiores assumenda consectetur deleniti ipsam molestiae molestias nemo nisi nulla officia officiis pariatur quaerat quas quasi qui ratione repellat, rerum sed similique sint suscipit temporibus totam unde velit voluptatum. Alias cum eum, ex itaque iusto nisi placeat possimus reiciendis.';

$mw = new MacrosoftWorld($text);
$mw->runCommand('copy', 70, 170);
$mw->runCommand('insert', 50, 51);
$mw->runCommand('cut', 30, 132);
$mw->down(3);
$mw->up(3);
$mw->getText();