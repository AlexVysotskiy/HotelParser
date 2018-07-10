<?php

namespace Tests\AppBundle;

use PHPUnit\Framework\TestCase;

class ValidatorsTest extends TestCase {

    /**
     * @dataProvider nameListsProvider
     */
    public function testName($name, $result) {

        $validator = new \AppBundle\Validator\NameValidator();

        $this->assertEquals($validator->validate($name), $result);
    }

    public function nameListsProvider() {
        return [
            [ 'Name § Name', false],
            [ 'Name', true],
            [ '', false],
        ];
    }
    
    /**
     * @dataProvider uriListsProvider
     */
    public function testUri($uri, $result) {

        $validator = new \AppBundle\Validator\UriValidator();

        $this->assertEquals($validator->validate($uri), $result);
    }

    public function uriListsProvider() {
        return [
            [ 'Name', false],
            [ 'www.qwe.xom', true],
            [ '', false],
        ];
    }

}
