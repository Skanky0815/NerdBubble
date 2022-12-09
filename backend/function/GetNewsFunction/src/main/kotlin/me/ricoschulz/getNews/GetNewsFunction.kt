package me.ricoschulz.getNews

import com.microsoft.azure.functions.*
import com.microsoft.azure.functions.annotation.*
import java.util.*

class GetNewsFunction {
    /**
     * This function listens at endpoint "/api/GetNewsFunction". Two ways to invoke it using "curl"
     * command in bash:
     * 1. curl -d "HTTP Body" {your host}/api/GetNewsFunction
     * 2. curl {your host}/api/GetNewsFunction?name=HTTP%20Query
     */
    @FunctionName("GetNewsFunction")
    fun run(
        @HttpTrigger(
            name = "req",
            methods = [HttpMethod.GET, HttpMethod.POST],
            authLevel = AuthorizationLevel.ANONYMOUS
        )
        request: HttpRequestMessage<Optional<String>>,
        context: ExecutionContext
    ): HttpResponseMessage {
        context.logger.info("Java HTTP trigger processed a request.")

        // Parse query parameter
        val query = request.queryParameters["name"]
        val name = request.body.orElse(query)

        return if (name == null) {
            request
                .createResponseBuilder(HttpStatus.BAD_REQUEST)
                .body("Please pass a name on the query string or in the request body")
                .build()
        } else {
            request.createResponseBuilder(HttpStatus.OK).body("Hello, $name").build()
        }
    }
}
