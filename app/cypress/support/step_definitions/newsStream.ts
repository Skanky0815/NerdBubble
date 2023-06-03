import { When, Then, Given } from "@badeball/cypress-cucumber-preprocessor";

Given("I visit {string} page", (route: string) => {
    cy.visit(route)
})

Then("I see the loading animation", () => {
    cy.contains('Loading...')
})

When("the articles are successful loaded", () => {
    cy.intercept('/api/articles').as('getArticles')
    cy.wait('@getArticles')
})

Then("I will see all articles", () => {
    cy.get('article').should('exist')
})

When("I click the reload button", () => {
    cy.get('button').click()
})

When("I click the first article",  () => {
    cy.get('article > a').first().invoke('attr', 'href').then(url => {
        cy.request(url).as('articlePageRequest')
    })
})

Then("the article page is loaded", () => {
    cy.get('@articlePageRequest').its('status').should('equals', 200)
})