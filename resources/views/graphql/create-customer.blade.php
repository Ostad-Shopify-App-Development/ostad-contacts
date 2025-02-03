mutation customerCreate($input: CustomerInput!) {
customerCreate(input: $input) {
userErrors {
field
message
}
customer {
id
email
firstName
lastName

}
}
}
