---
layout: docs-en
title: Semantic Terms
category: Manual
permalink: /manuals/1.0/en/semantic-terms.html
---

# Recommended Semantic Terms

## Overview

This document provides a complete list of terms from [Schema.org](https://schema.org) vocabulary that can be used as semantic descriptors (id) in ALPS profiles.

### Usage

1. When starting API design, first select appropriate terms from 🔵 Core Terms.
2. If more detailed expression is needed, consider 🟡 Extended Terms.
3. For special use cases, consider ⚪ Full Terms.
4. You can find terms by category using the category index.
5. Regarding domain-specific terms:
- Define industry or business-specific terms as custom semantic descriptors
- Naming convention: domainName + PropertyName (e.g., orderShippingStatus, medicalDiagnosisCode)
- It is recommended to build on Schema.org terms while making necessary extensions
- When defining domain-specific terms, it's important to clearly document their meaning and usage

### Category Index

1. [Basic Properties](#basic-properties)
2. [Identifiers & References](#identifiers-references)
3. [Metadata](#metadata)
4. [Dates & Periods](#dates-periods)
5. [Text & Content](#text-content)
6. [Media & Files](#media-files)
7. [Person & Individual](#person-individual)
8. [Organization & Group](#organization-group)
9. [Address & Location](#address-location)
10. [Products & Services](#products-services)
11. [Price & Payment](#price-payment)
12. [Events & Activities](#events-activities)
13. [Reviews & Ratings](#reviews-ratings)
14. [Education & Learning](#education-learning)
15. [Medical & Health](#medical-health)
16. [Finance & Transactions](#finance-transactions)
17. [Reservations & Scheduling](#reservations-scheduling)
18. [Communication](#communication)
19. [Security & Access Control](#security-access-control)
20. [Workflow & Process](#workflow-process)
21. [Technical & System](#technical-system)
22. [Legal & Terms](#legal-terms)
23. [Other Attributes](#other-attributes)

---

## Terms by Category

### Basic Properties

| Term | Level | Description |
|------|--------|------------|
| name | 🔵 | Name |
| description | 🔵 | Description |
| url | 🔵 | URL |
| alternateName | 🔵 | Alternative name |
| title | 🔵 | Title |
| text | 🔵 | Text |
| value | 🔵 | Value |
| additionalValue | 🟡 | Additional value |
| defaultValue | 🟡 | Default value |
| maxValue | 🟡 | Maximum value |
| minValue | 🟡 | Minimum value |
| multipleValues | 🟡 | Multiple values |
| propertyID | 🟡 | Property ID |
| valueReference | 🟡 | Value reference |
| valueRequired | 🟡 | Required value |
| unitCode | ⚪ | Unit code |
| unitText | ⚪ | Unit text |
| propertyType | ⚪ | Property type |
| propertyValue | ⚪ | Property value |
| measurementTechnique | ⚪ | Measurement technique |

### Identifiers & References

| Term | Level | Description |
|------|--------|------------|
| identifier | 🔵 | Identifier |
| id | 🔵 | ID |
| sameAs | 🔵 | Same as reference |
| mainEntity | 🔵 | Main entity |
| about | 🟡 | About |
| mentions | 🟡 | Mentions |
| citation | 🟡 | Citation |
| reference | 🟡 | Reference |
| referencesOrder | 🟡 | Reference order |
| isBasedOn | 🟡 | Is based on |
| isPartOf | 🟡 | Is part of |
| hasPart | 🟡 | Has part |
| itemListElement | 🟡 | Item list element |
| itemListOrder | 🟡 | Item list order |
| position | 🟡 | Position |
| isVersionOf | ⚪ | Is version of |
| predecessorOf | ⚪ | Predecessor of |
| successorOf | ⚪ | Successor of |
| isRelatedTo | ⚪ | Is related to |
| isSimilarTo | ⚪ | Is similar to |
| isVariantOf | ⚪ | Is variant of |
| exampleOfWork | ⚪ | Example of work |
| workExample | ⚪ | Work example |
| isBasedOnUrl | ⚪ | Is based on URL |

### Metadata

| Term | Level | Description |
|------|--------|------------|
| version | 🔵 | Version |
| status | 🔵 | Status |
| category | 🔵 | Category |
| keywords | 🔵 | Keywords |
| type | 🔵 | Type |
| format | 🔵 | Format |
| language | 🔵 | Language |
| source | 🔵 | Source |
| license | 🟡 | License |
| creator | 🟡 | Creator |
| editor | 🟡 | Editor |
| publisher | 🟡 | Publisher |
| contributor | 🟡 | Contributor |
| rights | 🟡 | Rights |
| copyrightHolder | 🟡 | Copyright holder |
| copyrightYear | 🟡 | Copyright year |
| creditText | 🟡 | Credit text |
| maintainer | 🟡 | Maintainer |
| schemaVersion | ⚪ | Schema version |
| usageInfo | ⚪ | Usage information |
| encoding | ⚪ | Encoding |
| isAccessibleForFree | ⚪ | Is accessible for free |
| conditionsOfAccess | ⚪ | Conditions of access |
| contentReferenceTime | ⚪ | Content reference time |

### Dates & Periods

| Term | Level | Description |
|------|--------|------------|
| dateCreated | 🔵 | Date created |
| dateModified | 🔵 | Date modified |
| datePublished | 🔵 | Date published |
| startDate | 🔵 | Start date |
| endDate | 🔵 | End date |
| startTime | 🔵 | Start time |
| endTime | 🔵 | End time |
| duration | 🔵 | Duration |
| validFrom | 🔵 | Valid from |
| validThrough | 🔵 | Valid through |
| dateDeleted | 🟡 | Date deleted |
| dateRead | 🟡 | Date read |
| dateReceived | 🟡 | Date received |
| dateSent | 🟡 | Date sent |
| dateIssued | 🟡 | Date issued |
| scheduleTime | 🟡 | Schedule time |
| birthDate | 🟡 | Birth date |
| deathDate | 🟡 | Death date |
| foundingDate | 🟡 | Founding date |
| dissolutionDate | 🟡 | Dissolution date |
| previousStartDate | ⚪ | Previous start date |
| uploadDate | ⚪ | Upload date |
| modifiedTime | ⚪ | Modified time |
| expires | ⚪ | Expires |
| temporalCoverage | ⚪ | Temporal coverage |

### Text & Content

| Term | Level | Description |
|------|--------|------------|
| title | 🔵 | Title |
| text | 🔵 | Text |
| content | 🔵 | Content |
| articleBody | 🔵 | Article body |
| headline | 🔵 | Headline |
| abstract | 🔵 | Abstract |
| description | 🔵 | Description |
| comment | 🔵 | Comment |
| contentType | 🔵 | Content type |
| encodingFormat | 🟡 | Encoding format |
| wordCount | 🟡 | Word count |
| characterCount | 🟡 | Character count |
| pagination | 🟡 | Pagination |
| pageStart | 🟡 | Page start |
| pageEnd | 🟡 | Page end |
| section | 🟡 | Section |
| chapter | 🟡 | Chapter |
| articleSection | 🟡 | Article section |
| speakable | ⚪ | Speakable text |
| textTemplate | ⚪ | Text template |
| cssSelector | ⚪ | CSS selector |
| xpath | ⚪ | XPath |
| transcript | ⚪ | Transcript |
| translationOfWork | ⚪ | Translation of work |
| workTranslation | ⚪ | Work translation |

### Media & Files

| Term | Level | Description |
|------|--------|------------|
| image | 🔵 | Image |
| audio | 🔵 | Audio |
| video | 🔵 | Video |
| file | 🔵 | File |
| fileSize | 🔵 | File size |
| fileFormat | 🔵 | File format |
| contentUrl | 🔵 | Content URL |
| thumbnailUrl | 🔵 | Thumbnail URL |
| downloadUrl | 🔵 | Download URL |
| embedUrl | 🟡 | Embed URL |
| height | 🟡 | Height |
| width | 🟡 | Width |
| duration | 🟡 | Duration |
| bitrate | 🟡 | Bitrate |
| encodingFormat | 🟡 | Encoding format |
| playerType | 🟡 | Player type |
| productionCompany | 🟡 | Production company |
| thumbnail | 🟡 | Thumbnail |
| uploadDate | 🟡 | Upload date |
| contentSize | 🟡 | Content size |
| encodesCreativeWork | ⚪ | Encodes creative work |
| associatedMedia | ⚪ | Associated media |
| requiresSubscription | ⚪ | Requires subscription |
| videoFrameSize | ⚪ | Video frame size |
| videoQuality | ⚪ | Video quality |
| hasDigitalDocumentPermission | ⚪ | Has digital document permission |

### Person & Individual

| Term | Level | Description |
|------|--------|------------|
| givenName | 🔵 | Given name |
| familyName | 🔵 | Family name |
| email | 🔵 | Email |
| telephone | 🔵 | Telephone |
| gender | 🔵 | Gender |
| birthDate | 🔵 | Birth date |
| nationality | 🔵 | Nationality |
| address | 🔵 | Address |
| jobTitle | 🔵 | Job title |
| additionalName | 🟡 | Additional name |
| honorificPrefix | 🟡 | Honorific prefix |
| honorificSuffix | 🟡 | Honorific suffix |
| birthPlace | 🟡 | Birthplace |
| deathDate | 🟡 | Death date |
| deathPlace | 🟡 | Death place |
| height | 🟡 | Height |
| weight | 🟡 | Weight |
| worksFor | 🟡 | Works for |
| alumniOf | 🟡 | Alumni of |
| awards | 🟡 | Awards |
| knows | ⚪ | Knows |
| colleagues | ⚪ | Colleagues |
| follows | ⚪ | Follows |
| parent | ⚪ | Parent |
| children | ⚪ | Children |
| sibling | ⚪ | Sibling |
| spouse | ⚪ | Spouse |
| homeLocation | ⚪ | Home location |
| workLocation | ⚪ | Work location |

### Organization & Group

| Term | Level | Description |
|------|--------|------------|
| organizationName | 🔵 | Organization name |
| legalName | 🔵 | Legal name |
| department | 🔵 | Department |
| address | 🔵 | Address |
| telephone | 🔵 | Telephone |
| email | 🔵 | Email |
| url | 🔵 | Website |
| foundingDate | 🟡 | Founding date |
| founder | 🟡 | Founder |
| numberOfEmployees | 🟡 | Number of employees |
| parentOrganization | 🟡 | Parent organization |
| subOrganization | 🟡 | Sub organization |
| member | 🟡 | Member |
| memberOf | 🟡 | Member of |
| taxID | 🟡 | Tax ID |
| vatID | 🟡 | VAT number |
| globalLocationNumber | ⚪ | GLN |
| duns | ⚪ | DUNS number |
| funder | ⚪ | Funder |
| sponsor | ⚪ | Sponsor |
| ownershipFundingInfo | ⚪ | Ownership funding info |
| slogan | ⚪ | Slogan |
| brand | ⚪ | Brand |
| dissolutionDate | ⚪ | Dissolution date |

### Address & Location

| Term | Level | Description |
|------|--------|------------|
| streetAddress | 🔵 | Street address |
| addressLocality | 🔵 | City/Town |
| addressRegion | 🔵 | State/Province |
| addressCountry | 🔵 | Country |
| postalCode | 🔵 | Postal code |
| location | 🔵 | Location |
| latitude | 🔵 | Latitude |
| longitude | 🔵 | Longitude |
| elevation | 🟡 | Elevation |
| postOfficeBoxNumber | 🟡 | PO box number |
| floor | 🟡 | Floor |
| room | 🟡 | Room |
| landmark | 🟡 | Landmark |
| areaServed | 🟡 | Area served |
| serviceArea | 🟡 | Service area |
| geo | 🟡 | Geographical coordinates |
| geoRadius | ⚪ | Geographical radius |
| geoCoveredBy | ⚪ | Geo covered by |
| geoCovers | ⚪ | Geo covers |
| geoDisjoint | ⚪ | Geo disjoint |
| geoIntersects | ⚪ | Geo intersects |
| geoTouches | ⚪ | Geo touches |
| containsPlace | ⚪ | Contains place |
| containedInPlace | ⚪ | Contained in place |

### Products & Services

| Term | Level | Description |
|------|--------|------------|
| productID | 🔵 | Product ID |
| sku | 🔵 | SKU |
| name | 🔵 | Product name |
| description | 🔵 | Product description |
| brand | 🔵 | Brand |
| manufacturer | 🔵 | Manufacturer |
| category | 🔵 | Category |
| price | 🔵 | Price |
| availability | 🔵 | Availability |
| color | 🟡 | Color |
| size | 🟡 | Size |
| weight | 🟡 | Weight |
| material | 🟡 | Material |
| model | 🟡 | Model |
| gtin | 🟡 | GTIN (Global Trade Item Number) |
| mpn | 🟡 | MPN (Manufacturer Part Number) |
| countryOfOrigin | 🟡 | Country of origin |
| productionDate | 🟡 | Production date |
| releaseDate | 🟡 | Release date |
| itemCondition | 🟡 | Item condition |
| width | ⚪ | Width |
| height | ⚪ | Height |
| depth | ⚪ | Depth |
| additionalProperty | ⚪ | Additional property |
| hasMerchantReturnPolicy | ⚪ | Has merchant return policy |
| hasWarranty | ⚪ | Has warranty |
| isFamilyFriendly | ⚪ | Is family-friendly |
| isAccessoryOrSparePartFor | ⚪ | Is accessory or spare part for |
| isConsumableFor | ⚪ | Is consumable for |

### Price & Payment

| Term | Level | Description |
|------|--------|------------|
| price | 🔵 | Price |
| priceCurrency | 🔵 | Price currency |
| paymentMethod | 🔵 | Payment method |
| paymentStatus | 🔵 | Payment status |
| paymentDue | 🔵 | Payment due |
| validFrom | 🔵 | Valid from |
| validThrough | 🔵 | Valid through |
| minPrice | 🟡 | Minimum price |
| maxPrice | 🟡 | Maximum price |
| priceValidUntil | 🟡 | Price valid until |
| discount | 🟡 | Discount |
| discountCode | 🟡 | Discount code |
| valueAddedTaxIncluded | 🟡 | VAT included |
| priceType | 🟡 | Price type |
| paymentAccepted | 🟡 | Payment accepted |
| paymentUrl | 🟡 | Payment URL |
| billingPeriod | ⚪ | Billing period |
| billingDuration | ⚪ | Billing duration |
| billingIncrement | ⚪ | Billing increment |
| billingStart | ⚪ | Billing start |
| downPayment | ⚪ | Down payment |
| installment | ⚪ | Installment |
| loanTerm | ⚪ | Loan term |
| monthlyMinimumPayment | ⚪ | Monthly minimum payment |

### Events & Activities

| Term | Level | Description |
|------|--------|------------|
| eventName | 🔵 | Event name |
| eventStatus | 🔵 | Event status |
| startDate | 🔵 | Start date |
| endDate | 🔵 | End date |
| location | 🔵 | Location |
| organizer | 🔵 | Organizer |
| performer | 🔵 | Performer |
| eventAttendanceMode | 🔵 | Event attendance mode |
| maximumAttendeeCapacity | 🟡 | Maximum attendee capacity |
| remainingAttendeeCapacity | 🟡 | Remaining attendee capacity |
| offers | 🟡 | Offers |
| doorTime | 🟡 | Door time |
| duration | 🟡 | Duration |
| inLanguage | 🟡 | In language |
| sponsor | 🟡 | Sponsor |
| superEvent | ⚪ | Super event |
| subEvent | ⚪ | Sub event |
| recordedIn | ⚪ | Recorded in |
| workFeatured | ⚪ | Work featured |
| workPerformed | ⚪ | Work performed |
| contributor | ⚪ | Contributor |

### Reviews & Ratings

| Term | Level | Description |
|------|--------|------------|
| review | 🔵 | Review |
| rating | 🔵 | Rating |
| ratingValue | 🔵 | Rating value |
| reviewBody | 🔵 | Review body |
| author | 🔵 | Author |
| datePublished | 🔵 | Date published |
| reviewRating | 🟡 | Review rating |
| bestRating | 🟡 | Best rating |
| worstRating | 🟡 | Worst rating |
| ratingCount | 🟡 | Rating count |
| reviewAspect | 🟡 | Review aspect |
| positiveNotes | 🟡 | Positive notes |
| negativeNotes | 🟡 | Negative notes |
| aggregateRating | 🟡 | Aggregate rating |
| itemReviewed | 🟡 | Item reviewed |
| recommendationStrength | ⚪ | Recommendation strength |
| associatedReview | ⚪ | Associated review |
| abridged | ⚪ | Abridged |

### Education & Learning

| Term | Level | Description |
|------|--------|------------|
| educationalLevel | 🔵 | Educational level |
| learningResourceType | 🔵 | Learning resource type |
| teaches | 🔵 | Teaches |
| courseCode | 🔵 | Course code |
| instructor | 🔵 | Instructor |
| courseWorkload | 🔵 | Course workload |
| competencyRequired | 🟡 | Competency required |
| educationalUse | 🟡 | Educational use |
| timeRequired | 🟡 | Time required |
| typicalAgeRange | 🟡 | Typical age range |
| assesses | 🟡 | Assesses |
| educationalAlignment | 🟡 | Educational alignment |
| educationalFramework | 🟡 | Educational framework |
| proficiencyLevel | ⚪ | Proficiency level |
| coursePrerequisites | ⚪ | Course prerequisites |
| educationalProgramMode | ⚪ | Educational program mode |
| occupationalCredentialAwarded | ⚪ | Occupational credential awarded |
| numberOfCredits | ⚪ | Number of credits |

### Medical & Health

| Term | Level | Description |
|------|--------|------------|
| medicalCondition | 🔵 | Medical condition |
| diagnosis | 🔵 | Diagnosis |
| treatment | 🔵 | Treatment |
| medication | 🔵 | Medication |
| symptoms | 🔵 | Symptoms |
| healthcareProvider | 🔵 | Healthcare provider |
| medicalSpecialty | 🟡 | Medical specialty |
| procedure | 🟡 | Procedure |
| dosageSchedule | 🟡 | Dosage schedule |
| adverseOutcome | 🟡 | Adverse outcome |
| contraindication | 🟡 | Contraindication |
| indication | 🟡 | Indication |
| sideEffect | 🟡 | Side effect |
| warning | 🟡 | Warning |
| activeIngredient | ⚪ | Active ingredient |
| administrationRoute | ⚪ | Administration route |
| recommendedIntake | ⚪ | Recommended intake |
| maximumIntake | ⚪ | Maximum intake |
| drugClass | ⚪ | Drug class |
| prescribingInfo | ⚪ | Prescribing information |

### Finance & Transactions

| Term | Level | Description |
|------|--------|------------|
| accountId | 🔵 | Account ID |
| accountName | 🔵 | Account name |
| accountType | 🔵 | Account type |
| amount | 🔵 | Amount |
| currency | 🔵 | Currency |
| transactionId | 🔵 | Transaction ID |
| transactionDate | 🔵 | Transaction date |
| balance | 🔵 | Balance |
| bankAccount | 🟡 | Bank account |
| creditCard | 🟡 | Credit card |
| interestRate | 🟡 | Interest rate |
| paymentDueDate | 🟡 | Payment due date |
| paymentStatus | 🟡 | Payment status |
| minimumPayment | 🟡 | Minimum payment |
| creditLimit | 🟡 | Credit limit |
| exchangeRate | 🟡 | Exchange rate |
| accountMinimumInflow | ⚪ | Account minimum inflow |
| accountOverdraftLimit | ⚪ | Account overdraft limit |
| annualPercentageRate | ⚪ | Annual percentage rate |
| beneficiaryBank | ⚪ | Beneficiary bank |
| cashBack | ⚪ | Cash back |
| loanType | ⚪ | Loan type |

### Reservations & Scheduling

| Term | Level | Description |
|------|--------|------------|
| reservationId | 🔵 | Reservation ID |
| reservationStatus | 🔵 | Reservation status |
| reservationFor | 🔵 | Reservation for |
| underName | 🔵 | Under name |
| reservationDate | 🔵 | Reservation date |
| startTime | 🔵 | Start time |
| endTime | 🔵 | End time |
| partySize | 🟡 | Party size |
| bookingTime | 🟡 | Booking time |
| bookingAgent | 🟡 | Booking agent |
| programMembershipUsed | 🟡 | Program membership used |
| modifiedTime | 🟡 | Modified time |
| cancelationPolicy | 🟡 | Cancelation policy |
| advanceBookingRequirement | ⚪ | Advance booking requirement |
| lodgingUnitType | ⚪ | Lodging unit type |
| lodgingUnitDescription | ⚪ | Lodging unit description |
| checkInTime | ⚪ | Check-in time |
| checkOutTime | ⚪ | Check-out time |
| amenityFeature | ⚪ | Amenity feature |

### Communication

| Term | Level | Description |
|------|--------|------------|
| sender | 🔵 | Sender |
| recipient | 🔵 | Recipient |
| messageText | 🔵 | Message text |
| subject | 🔵 | Subject |
| dateSent | 🔵 | Date sent |
| dateReceived | 🔵 | Date received |
| messageStatus | 🔵 | Message status |
| messageType | 🟡 | Message type |
| inReplyTo | 🟡 | In reply to |
| ccRecipient | 🟡 | CC recipient |
| bccRecipient | 🟡 | BCC recipient |
| messageAttachment | 🟡 | Message attachment |
| replyToUrl | 🟡 | Reply to URL |
| discussionUrl | 🟡 | Discussion URL |
| toRecipient | ⚪ | To recipient |
| aboutPerson | ⚪ | About person |
| aboutOrganization | ⚪ | About organization |
| mentions | ⚪ | Mentions |

### Security & Access Control

| Term | Level | Description |
|------|--------|------------|
| accessibilityControl | 🔵 | Accessibility control |
| permission | 🔵 | Permission |
| permissionType | 🔵 | Permission type |
| authenticator | 🔵 | Authenticator |
| securityClearance | 🔵 | Security clearance |
| accessCode | 🟡 | Access code |
| accessModeSufficient | 🟡 | Access mode sufficient |
| accessibilityAPI | 🟡 | Accessibility API |
| accessibilityFeature | 🟡 | Accessibility feature |
| accessibilityHazard | 🟡 | Accessibility hazard |
| conditionsOfAccess | 🟡 | Conditions of access |
| hasDigitalDocumentPermission | 🟡 | Has digital document permission |
| permissionAssertion | ⚪ | Permission assertion |
| securityScreening | ⚪ | Security screening |

### Workflow & Process

| Term | Level | Description |
|------|--------|------------|
| status | 🔵 | Status |
| stage | 🔵 | Stage |
| processType | 🔵 | Process type |
| currentStatus | 🔵 | Current status |
| action | 🔵 | Action |
| actionStatus | 🔵 | Action status |
| workflowStep | 🟡 | Workflow step |
| predecessor | 🟡 | Predecessor |
| successor | 🟡 | Successor |
| approver | 🟡 | Approver |
| assignee | 🟡 | Assignee |
| dueDate | 🟡 | Due date |
| priority | 🟡 | Priority |
| escalationLevel | ⚪ | Escalation level |
| workflowTemplate | ⚪ | Workflow template |
| decisionPoint | ⚪ | Decision point |
| conditionalStep | ⚪ | Conditional step |
| parallelStep | ⚪ | Parallel step |

### Technical & System

| Term | Level | Description |
|------|--------|------------|
| softwareVersion | 🔵 | Software version |
| operatingSystem | 🔵 | Operating system |
| applicationCategory | 🔵 | Application category |
| programmingLanguage | 🔵 | Programming language |
| systemRequirements | 🔵 | System requirements |
| softwareRequirements | 🟡 | Software requirements |
| processorRequirements | 🟡 | Processor requirements |
| memoryRequirements | 🟡 | Memory requirements |
| storageRequirements | 🟡 | Storage requirements |
| installUrl | 🟡 | Install URL |
| downloadUrl | 🟡 | Download URL |
| codeRepository | 🟡 | Code repository |
| applicationSubCategory | ⚪ | Application subcategory |
| applicationSuite | ⚪ | Application suite |
| availableOnDevice | ⚪ | Available on device |
| browserRequirements | ⚪ | Browser requirements |

### Legal & Terms

| Term | Level | Description |
|------|--------|------------|
| termsOfService | 🔵 | Terms of service |
| privacyPolicy | 🔵 | Privacy policy |
| license | 🔵 | License |
| copyright | 🔵 | Copyright |
| legalStatus | 🔵 | Legal status |
| jurisdiction | 🟡 | Jurisdiction |
| legislationType | 🟡 | Legislation type |
| regulations | 🟡 | Regulations |
| disclaimer | 🟡 | Disclaimer |
| compliance | 🟡 | Compliance |
| legalName | 🟡 | Legal name |
| legislationDate | ⚪ | Legislation date |
| legislationIdentifier | ⚪ | Legislation identifier |
| legislationPassedBy | ⚪ | Legislation passed by |
| legislationResponsible | ⚪ | Legislation responsible |
| governmentBenefitsInfo | ⚪ | Government benefits info |

### Other Attributes

| Term | Level | Description |
|------|--------|------------|
| status | 🔵 | Status |
| type | 🔵 | Type |
| category | 🔵 | Category |
| order | 🔵 | Order |
| priority | 🔵 | Priority |
| tag | 🔵 | Tag |
| group | 🔵 | Group |
| relation | 🔵 | Relation |
| source | 🔵 | Source |
| target | 🔵 | Target |
| origin | 🟡 | Origin |
| destination | 🟡 | Destination |
| sortOrder | 🟡 | Sort order |
| rank | 🟡 | Rank |
| score | 🟡 | Score |
| level | 🟡 | Level |
| theme | 🟡 | Theme |
| style | 🟡 | Style |
| layout | 🟡 | Layout |
| template | 🟡 | Template |
| format | 🟡 | Format |
| mode | 🟡 | Mode |
| state | 🟡 | State |
| phase | 🟡 | Phase |
| context | 🟡 | Context |
| scope | 🟡 | Scope |
| flags | ⚪ | Flags |
| options | ⚪ | Options |
| settings | ⚪ | Settings |
| preferences | ⚪ | Preferences |
| configuration | ⚪ | Configuration |
| customization | ⚪ | Customization |
| variant | ⚪ | Variant |
| alternative | ⚪ | Alternative |
| fallback | ⚪ | Fallback |
| override | ⚪ | Override |
| default | ⚪ | Default |
| custom | ⚪ | Custom |
| external | ⚪ | External |
| internal | ⚪ | Internal |
| public | ⚪ | Public |
| private | ⚪ | Private |
| hidden | ⚪ | Hidden |
| visible | ⚪ | Visible |
| enabled | ⚪ | Enabled |
| disabled | ⚪ | Disabled |
| locked | ⚪ | Locked |
| archived | ⚪ | Archived |
| deleted | ⚪ | Deleted |
| deprecated | ⚪ | Deprecated |

## Conclusion

This document is continuously updated and new terms and usage patterns may be added.

### Importance Levels

All terms are classified into three levels based on importance and frequency of use:

- 🔵 **Core Terms**: Essential key terms for basic APIs (about 10-15% of total)
🔵 **Core Terms**: Essential key terms for basic APIs (about 10-15% of total)
  - Fundamental vocabulary used in most applications
  - First choice when creating simple APIs
  - Terms necessary for common CRUD operations

🟡 **Extended Terms**: Commonly used extended terms (about 30-35% of total)
  - Vocabulary needed for specific domains and more detailed expressions
  - Terms commonly used in general business applications
  - Options when richer expressiveness is needed

⚪ **Full Terms**: Special purpose terms (about 50-55% of total)
  - Vocabulary needed for specific industries and special use cases
  - Options when complete compatibility is needed
  - Terms for very specialized expressions

### Usage Notes

2. **Naming Conventions**:
- Use lowerCamelCase format
- Avoid abbreviations, use complete words
- Maintain consistent naming patterns

3. **Customization**:
- Can add custom terms as needed
- Recommend using appropriate prefixes for industry-specific terms
- Strive for unified term usage within organization

4. **Interoperability**:
- Consider compatibility with Schema.org
- Prioritize standard terms
- Clearly document when making custom extensions

### Reference Resources

- [Schema.org](https://schema.org)
- [IANA Link Relations](https://www.iana.org/assignments/link-relations/link-relations.xhtml)
- [ALPS Specification](http://alps.io/spec/)

