#iiko sandbox services
    exchange.iiko.auth.sandbox.digest_auth_data:
        class: iikoExchangeBundle\Library\base\Connection\DigestConnectionInfo
        arguments: ["%iiko_exchanger_server%", "%iiko_exchanger_user%", "%iiko_exchanger_password_hash%"]


    class: iikoExchangeBundle\Library\iiko\Connection\iikoConnection
        calls:
            - [setAuthStorage, ["@exchange.iiko.auth.storage"]]
            - [setLogger, ["@logger"]]
            - [withConnectionInfo, ["@exchange.iiko.auth.sandbox.digest_auth_data", false]]