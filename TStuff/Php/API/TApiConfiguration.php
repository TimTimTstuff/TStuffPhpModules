<?php



namespace TStuff\Php\API   {

    abstract class TApiConfiguration  {
          /**
         * Undocumented variable
         *
         * @var string[]
         */
        const HeaderMap = [
            "create" => "POST",
            "update" => "PUT",
            "read" => "GET",
            "delete" => "DELETE"
        ];

        /**
         * Undocumented variable
         *
         * @var int[]
         */
        const ErrorMap = [
            "created" => 201,
            "ok" => 200,
            "no_content" => 204,
            "not_found" => 404,
            "bad_request" => 400,
            "method_not_allowed" => 405,
            "unauthorized" => 401,
        ];
    }
}