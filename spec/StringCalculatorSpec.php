<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class StringCalculatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('StringCalculator');
    }

    function it_returns_zero_for_an_empty_string()
    {
    	$this->add("")->shouldBe(0);
    }

    function it_translates_a_string_to_int()
    {
    	$this->add("1")->shouldBe(1);
    }

    function it_finds_the_sum_of_an_amount_of_numbers()
    {
    	$this->add("1,2")->shouldBe(3);
    }

    function it_accept_new_line_character_as_delimiter()
    {
    	$this->add("3\n3")->shouldBe(6);
    	$this->add("3\n3,2")->shouldBe(8);
    }


    function it_accept_custom_delimiter()
    {
    	$this->add("//;\n3;7")->shouldBe(10);
    }

    function it_desallows_negative_numbers()
    {
    	$this->shouldThrow(new \InvalidArgumentException("The negative numbers are not allowed : -1,-2,-5"))->during("add",["-1,3,4,-2,9,-5"]);
    }


    function it_ignores_all_numbers_greater_than_1000()
    {
    	$this->add("2,1001")->shouldBe(2);
    }

    function it_accept_any_length_of_delimiter()
    {
    	$this->add("//[***]\n1***2***3")->shouldBe(6);
    }


    function it_allows_multiple_delimiters()
    {
    	$this->add("//[*][%]\n1*2%3")->shouldBe(6);
    }

    function it_allows_delimiters_with_length_longer_than_one_char()
    {
    	$this->add("//[**][%o]\n1**2%o3**4")->shouldBe(10);
    }

}
