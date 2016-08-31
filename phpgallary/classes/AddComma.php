<?php
class AddComma extends CachingIterator
{
    public function current()
    {
        if (parent::hasNext()) {
            return parent::current() . ',';
        } else {
            return parent::current();
        }
    }
}