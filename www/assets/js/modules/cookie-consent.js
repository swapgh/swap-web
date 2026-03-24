window.Swap = window.Swap || {};
window.Swap.cookieConsent = (() => {
  const consentCookieName = "swap_cookie_consent";

  const readCookie = (name) => {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) {
      return parts.pop().split(";").shift() || "";
    }
    return "";
  };

  const writeCookie = (name, value, days = 180) => {
    const expires = new Date(Date.now() + days * 86400000).toUTCString();
    const secureFlag = window.location.protocol === "https:" ? "; Secure" : "";
    document.cookie = `${name}=${value}; expires=${expires}; path=/; SameSite=Lax${secureFlag}`;
  };

  const getConsentRecord = () => {
    const localValue = window.localStorage.getItem(consentCookieName);
    if (localValue) {
      try {
        return JSON.parse(localValue);
      } catch (_) {
        window.localStorage.removeItem(consentCookieName);
      }
    }

    const cookieValue = readCookie(consentCookieName);
    if (!cookieValue) {
      return null;
    }

    try {
      return JSON.parse(decodeURIComponent(cookieValue));
    } catch (_) {
      return null;
    }
  };

  const setConsentRecord = (choice) => {
    const record = {
      choice,
      updated_at: new Date().toISOString(),
      source: "banner",
    };

    const serialized = JSON.stringify(record);
    window.localStorage.setItem(consentCookieName, serialized);
    writeCookie(consentCookieName, encodeURIComponent(serialized));
    document.documentElement.dataset.cookieConsent = choice;
    return record;
  };

  const init = () => {
    const banner = document.getElementById("cookie-banner");
    const consentRecord = getConsentRecord();

    if (consentRecord?.choice) {
      document.documentElement.dataset.cookieConsent = consentRecord.choice;
    } else if (banner) {
      banner.hidden = false;
    }

    document.querySelectorAll("[data-cookie-consent]").forEach((button) => {
      button.addEventListener("click", () => {
        const choice = button.getAttribute("data-cookie-consent") || "essential";
        setConsentRecord(choice);
        if (banner) {
          banner.hidden = true;
        }
      });
    });
  };

  return { init };
})();
