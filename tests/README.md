# Laravel Navigation Tests

This directory contains tests for the Laravel Navigation package. The tests are organized into unit tests and feature tests.

## Unit Tests

### Components Tests

- **MobileNavigationTest**: Tests for the MobileNavigation component, including background class handling and view rendering.
- **DesktopNavigationTest**: Tests for the DesktopNavigation component, including trigger handling and view rendering.
- **DesktopDropdownButtonTest**: Tests for the DesktopDropdownButton component, including name and links handling.
- **NavigationScrollTest**: Tests for the NavigationScroll component, including transparency handling.

### Core Tests

- **NavigationTest**: Tests for the Navigation class, including navigation item retrieval, dropdown route activation, and configuration getters.
- **NavigationServiceProviderTest**: Tests for the NavigationServiceProvider, ensuring it correctly registers the package with Laravel.

## Feature Tests

- **NavigationIntegrationTest**: Tests for the integration between different components of the package, ensuring they work together correctly.

## Running Tests

To run the tests, use the following command:

```bash
./vendor/bin/pest
```

## Test Coverage

The tests cover the following aspects of the package:

1. **Component Rendering**: Tests that components render the correct views.
2. **Component Properties**: Tests that component properties are correctly set and handled.
3. **Navigation Configuration**: Tests that navigation configuration is correctly retrieved and used.
4. **Integration**: Tests that different components of the package work together correctly.

## Edge Cases

The tests also cover various edge cases, including:

1. **Empty Arrays**: Testing how components handle empty arrays.
2. **Different Input Types**: Testing how components handle different input types (string, array, object, boolean).
3. **Null Values**: Testing how components handle null values.
4. **Collection Conversion**: Testing that arrays are correctly converted to collections.

## Recent Fixes

The following issues were fixed in the test suite:

1. **NavigationServiceProvider Registration**: Added `register()` and `provides()` methods to properly register the Navigation singleton and facade alias.
2. **View Mocking**: Updated the view mocking in integration tests to use more flexible parameter matching with `withArgs()` callbacks.
3. **Request Mocking**: Fixed request mocking in NavigationTest to properly handle the `setUserResolver` method by creating a mock of the Request class and replacing the instance in the container.

## Future Improvements

Potential future improvements to the test suite could include:

1. **More Integration Tests**: Additional tests for how the package integrates with a Laravel application.
2. **Browser Tests**: Tests for how the components render in a browser.
3. **Performance Tests**: Tests for the performance of the package under load.
