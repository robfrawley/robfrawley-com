Feature: Config values should be injected into the container via Yaml config files

  Scenario: Check the RfBlogBundle config values
    Given The app kernel is available
    And The container is available
    Then Container should have parameter "rf.maintenance_mode.enable"
    And Container should have parameter "rf.maintenance_mode.mode"
    And Container should have parameter "rf.html.title_pre"
    And Container should have parameter "rf.html.title_post"
    And Container should have parameter "rf.html.lang"
    And Container should have parameter "rf.html.charset"