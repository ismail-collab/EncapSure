package com.example.Controller;


import org.springframework.context.annotation.Bean;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
public class RESTController {

    @Bean
    public String testing() {
        System.out.println("hey");
        return "hi";
    }

}
