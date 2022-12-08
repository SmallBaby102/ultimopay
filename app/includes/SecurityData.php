<?php

namespace App\includes;

class SecurityData
{
    /**
     * JWE Key Id.
     *
     * @var string
     */
    public static $EncryptionKeyId = "7664a2ed0dee4879bdfca0e8ce1ac313";

    /**
     * Access Token.
     *
     * @var string
     */
    public static $AccessToken = "c34ba20734d84d30a8ab6be489837a1f";

    /**
     * Token Type - Used in JWS and JWE header.
     *
     * @var string
     */
    public static $TokenType = "JWT";

    /**
     * JWS (JSON Web Signature) Signature Algorithm - This parameter identifies the cryptographic algorithm used to
     * secure the JWS.
     *
     * @var string
     */
    public static $JWSAlgorithm = "PS256";

    /**
     * JWE (JSON Web Encryption) Key Encryption Algorithm - This parameter identifies the cryptographic algorithm
     * used to secure the JWE.
     *
     * @var string
     */
    public static $JWEAlgorithm = "RSA-OAEP";

    /**
     * JWE (JSON Web Encryption) Content Encryption Algorithm - This parameter identifies the content encryption
     * algorithm used on the plaintext to produce the encrypted ciphertext.
     *
     * @var string
     */
    public static $JWEEncrptionAlgorithm = "A128CBC-HS256";

    /**
     * Merchant Signing Private Key is used to cryptographically sign and create the request JWS.
     *
     * @var string
     */
    public static $MerchantSigningPrivateKey = "MIIJQwIBADANBgkqhkiG9w0BAQEFAASCCS0wggkpAgEAAoICAQCgHzpd18Co5+J09PnQCkWsdgyHHNEBpAqzmbf5JanCwpzyZTjfP/iqbv5R2YPgv9YjnXZVYbRc/tj3UwBeF7b+niJNvA5LlcHbYtbigZLUceWgrqeRaIgOFe8PkeIp6++53HWB9AA+2gvz9yrxefNiVZRsPy7IzHcNqGk+mNJqTVvoYP8BcRKlCscgaNd4k4PZmfPhbJ7ZkekidB/M0zECwKmZI0zq2ABz9ZvsxTtMKU/j7Nm92xlnWk5pZCQjTj3WDxwhdJU6V8ISyOSbo5Vs3A95S3utwJ+ERy0CgetPbbfJzorBYK0iiUwi3wmrF7yZZ6BhJ6NsxECilSptaq9Iw0LjOnycz9r23odT7f0vhxv2FWJ/EmNE/gOH1GYXpsn0iCvPwzS/+dUymkx/yskuz4EbjYpGLnE47bKR6LupS/DO8PCaPucKQRZI7I0+6pT9dQJafOHy32b24gMvHfaXKQQnmaPOqvDtdhyM54OZdUtk6JiiVCJTBVG0muMkY/M1pdGzXMm3uR5PqnYfJjmo1QilnSm4KPiVIoE1BchQCmCUZCe3n9Ztm10ecwf273tMRhkG3NdTWQ5WXbK9HVvKp2mWjtn0FzmhG3NSw0JhZzGVhFuGRLzjBMGCfKT6vkUdh4G6eHZRNDrCtVEVb0IAZsAJFwHQMXwdODkVakiT6QIDAQABAoICAHadK3uA6/Mzc4n4P2ZhdaN//1/HdPymLFdHNAWYZN0llWXqneqjVO3MMxEm9I51DYhsiNBPBHEvSEJOdiM9pg2PzxGOkXhkg6qk2VIJcl910Ajr2K3apY7pqKH8C3HKmVcxfMq7mcL1e41KN8GR+T2K79wQIfQVosu3Sd9ZDeY5UDAgSkcjIBCqnz/e6l8jx7RWW1dOQ44gjHc9VqFAgTnsxrXudHgzcoJ0GwGWSYrtv4S0W8hMmdD6EMP5rtuIhj4gC1KtLi59/AI2V0MENxjhG4Va6U+ZNZGjuC/3Vf0M5ezU1+zQVPEUjBX46wyXFNr+7MuLtYBJEShfH4LWWOl9jQsAc8CrMQlBG2aPKXa0a2ygubwsEUVKDcJCsygAL5lb9WLQJjsh/DKv/y2AWHWAQdEME6pzVijymW8Td4CfNJS1Pysy+mLzMvPufeFgT7XcGRvz2Eg3/7H6pBnBGSNPnVCY25BCotOzRGjnF5OAXarBWgUyydWDxFeGttOqgtZjkljS8IBpmwamiAksas6Ndh5WvvryGOVVSPGc28o5uyMU+bBn+fgGUpf3rNzamNoj+0I10ZLTlfI1IDWPyAqJ2NhgZOVdbO8qWtPrfeaV/E+2DLIytTcLds9WwezomYr4njGPapJ4vVEcEUC5iE5IZwxF4F9LYGz38jLJGGIBAoIBAQDUbCQdkl64FxzzinwA+3Vxtit7tAdkOKfSdrIiJXAmj8zkVDna7WYIjDuyHoJG95+QgkEz7kFqHmqbJIh9zLyNEZKI6oATM9T2J2/tbQ58swFkCadGKpc0m4oFNtZbvMMCgKBkockquyuGo4kUlbiPsxK8nqoZtkGAJBPeGE/O5aMlJ9PuaqcSz+v3+0HHTJu7hD9VPw0bAayx0Zu74Ba0GpASfIofs/lg3Oh1uyGUd0C2NA9zq34lesHkixLypI8GM+aTpTkl697A9Tl/bAcXjdHYKAqxht4EC9eteCapgcjnd6HbxYM2q194Dx3vheiMUhV1PtB7nzbB/hAssk/5AoIBAQDA+GhEYrz9tO+8xT7NOF4nBQ444B1U38qmL+ZAYztXhUyjfXwaY5kXp+X9XihgoDxJD2y+R8MBckZFjJ1ghWX+BEZfm8slkyiQyAq/CX6LXUe0gd1PNBPuFIroMsUazJwE7mG8OzKK+NR8XsZiUE28DsKZoeUX0H0FOJ7tsYck/w5NktZwXj7vxkHFrlpnqIxOqrRhyk2mskE6bIfFu+RuewSigyMHpDyAInFKKCv8Qlk90OVZlcGO5y5pUqMZ1VHZ7kcKFzEBngNdSZD5VDNwK5H3WgR3+9DmkPOR+qFG6HoNkRkRT36vqqEjeFw44SdaPkIHJmxA/ZzpBT3ATT9xAoIBAQDJcpDBdpjbDhhHofI9YDsdjnwoQS+tTMlin2wJU+XKvB67/mArjW1w98R5A9Pah2TMP6qkG/PvNk81N+01GB9LzPlhXLn+++2fTwEncYAGpB/ShhEbSrLAkizPCxU4RIfPbLovFPrYyk3ZzmbmnaI8rL89H18DKUNuyUgKHJY7CK2yQ9YJSR2Oip4mOyJDZhRePWluZ2//R5RFwhllj3sYbARrc63tqNj7kiPl2oRa7sjwwehRcrYbxxHvsjBS6do1MK0fIdZTbx99cFGJ1KHZJYZ27mpNty//OFfeS46mu80SLfLSn7ny84yDKBrkluJViFaPLPW79t6QFGe0a5nJAoIBAApqHa57KboDluC4QIBw51vxwOe+6LZY8aXwddvJvz0k+5LjRdxivbNyI05+U22LmFVVGMhYNSUR1ssQILpB2NRRxL6KOPeJLqpJsZLH32WEHkeWrqwEooK55xlLDCo7GryFZQ70nvCzJzyjHM/Xh6p7nXMPMr8LSIQMnz8y0pljjpEPOLWN0JW+PHR/yW9IwHHKcrvIYFJ70ltl2hoI3vY7e2+N5kkWSxGbSkP3URBnQEu+x3IDTBP7VBzpEdZmFenOG1VnFQUCUyoou0NJkREfuNwBprYXCBo5fnvFbAjYqSWsTA8MHEk8yz+P0mJbfHU5YPTj1PnY9iv5VXDYenECggEBAJE9OK35c9+mrBmz1ZB+3XP8vkwlxRMw/PBpjQ/JGhk6Wa6DQ1C9j64Mqq/AQRUWWHjGuU+0eVIv8RGVatN7dtJCnsGZsR1qSqCXbnNEcFC+bYjiG8EZmzLcM4Urd9rGHjOnLbrJIUwbx3LtANZLT7HvowUE8UBbJ8Hw9Svo16FdWT6PuVqa773X1c1kXH9S732wqe/ujq1HoEhAYS0M8TgFiR3KRhWtoy7Fu0aw5FOfEPTKsND99WiYjIwhU3fXJ8vG5kPq1YG4+T2OQc5GzEB9jDfd0kWHQtJ6TfH33P5LRlJJyGKJU3htxiZyC4CkiDGeb6NuPIo5V92Qx5QorTA=";
    /**
     * PACO Encryption Public Key is used to cryptographically encrypt and create the request JWE.
     *
     * @var string
     */
    public static $PacoEncryptionPublicKey = "MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEAviq4wrTmVMkRHouiHLUonJ1d6ss6nNreJ0JWpLwmTwAM7l35g8AFIvE8PqwWevtjuil9JZ1T1zwQTP8aM3s5/RzX5yFIhec/O14jib7Nmi4jACeJqDlHsnYzeCPw8WOhgmxWKHcORNLpn68jgnhLrKwh3Mooz/hXtIwGuNe/pYU7i/QaiuOjtmIcQ3yxJWjiHsllaogobZjbwMzwhp1fJ6ELmZp0FJvDrE8dn4UU9yzPFNzQ4gJzJAS/JKLXjfDw5mDQdw80vbzYuxksU0bc/3+DwY6hqaVJsP2AST7dCTR1wYzevzPxp0HMDmz1Ia/hSrmTPRhSa0qvxHMriVHUJvJeLTNI3cWM0RI9ukR7/v6vcf8ZwOZ+u7w4YfLpPCQFN7zGUN9Hho0pWBVYOstqsF5h/ZgBOlEHgSYY3CJdscV1+vKUvmFPiwkOdVxhc571RX56o+V71ZIGjXeYeqd3KNnND1JNsOn4hRPbk8Cl0e8CfZnEePfqtbFQGrzRU3GvSXscMb51TlvZu9i0toJdIJ4DiOCkUlB2sDI4x7N9ROOEbAD8uv68/jZqTM2paUNRN7Xvaa2LUCis3acadiyLt0tpuOT0sY2OejhLJshwNfTfc67gdtCJ3diddZWkXYpBgkMhuVj3TSx85sUklbGGJkzkwNsC0JhMSo7ZqbYxczECAwEAAQ==";
    /**
     * PACO Signing Public Key is used to cryptographically verify the response JWS signature.
     *
     * @var string
     */
    public static $PacoSigningPublicKey = "MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEAkEOCDQxCbyv/n1jadyDDL9KLRddF7W2eVNf7GwVeqlq3CVor0QHiU+yweO3b622NZAPDBy/GFeJJH5lwdJUbYojFWtHUqYN7/HoTHF50KhAbLMhnllsULuyVgG1l3m9xSjRJtQSaIZP5jF4LSM+m69Xd7U2qoTczMOaNZ36yWZzxN/OUQMjb2cWeZCLhVPf6zJwA35kC57NK2n1DDvvyFvLnh9gBd8EOkJuT9us1r01Ya3XpFHhXy1fTg9bmWXDMwMm5stnhmGOF2d6Uv4rYGqk67nRzX0ZEGrWW6X0tzeQESkQShx0algKIXeM/2RBfit1QHDHhI70CYTqt1eG05Cpr5u7FdvD4pk8fqfW8xJsmoZisQNQnov0oriUqrB1wZvWL8+calfoX0nxWMVlP37LspA6O2+dlnjFxpDQSjnfWVFyS6fKvr8jXWI6KG6L11J+yAXY4KjqGK+wEnH2yf8tK8NLkIAWNstlUQrycEkk4mP6ElKwkOMpRND0ArG1cG0uMx+VXd1vrWG6UePa+GHmgHbgLSkjI3hpz3wbpE5cbp73dbIgryeC0AeLY7kKDt7pMQpkg3gNxcvTGXjZYc1TQ5siuD1RBJUR5Lv/P8jjyQnB4D67AEuL1pw5acKQ3tfOEF+iuzzzV5zeSj5T5rYR1GpuPOqTz97AWSxawDUsCAwEAAQ==";
    /**
     * Merchant Decryption Private Key used to cryptographically decrypt the response JWE.
     * @var string
     */
    public static $MerchantDecryptionPrivateKey = "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";
}