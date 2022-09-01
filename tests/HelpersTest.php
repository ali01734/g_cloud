<?php

class HelpersTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testJoinPaths()
    {
        $this->assertEquals(
            '/tmp/lessons/f.jpg',
            join_paths('/tmp/lessons/', 'f.jpg')
        );

        $this->assertEquals(
            '/tmp/lessons/f.jpg',
            join_paths('/tmp/lessons/', '/f.jpg')
        );

        $this->assertEquals(
            '/tmp/lessons/f.jpg',
            join_paths('/tmp/lessons', 'f.jpg')
        );
    }

    public function testTmpImgPath()
    {

        $this->assertEquals(
            public_path(join_paths(config('app.tmp_photo_folder'), 'hh.jpg')),
            tmp_img_path('hh.jpg')
        );

        $this->assertEquals(
            public_path(config('app.tmp_photo_folder')),
            tmp_img_path()
        );
    }
}
