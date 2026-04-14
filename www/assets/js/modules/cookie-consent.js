window.Swap = window.Swap || {};
window.Swap.cookieConsent = (() => {
  const consentCookieName = "swap_cookie_consent";
  const analyticsConfig = window.Swap.analytics || {};
  const consentVersion = String(analyticsConfig.consentVersion || "");

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

  const shouldShowBanner = (record) => {
    if (!record || typeof record !== "object") {
      return true;
    }

    return String(record.version || "") !== consentVersion || !record.choice;
  };

  const loadAnalytics = () => {
    const tagId = String(analyticsConfig.tagId || "").trim();
    if (!tagId || window.Swap.analyticsLoaded) {
      return;
    }

    window.Swap.analyticsLoaded = true;
    const script = document.createElement("script");
    script.async = true;
    script.src = `https://www.googletagmanager.com/gtag/js?id=${encodeURIComponent(tagId)}`;
    document.head.appendChild(script);

    window.dataLayer = window.dataLayer || [];
    window.gtag = function gtag() {
      window.dataLayer.push(arguments);
    };

    window.gtag("js", new Date());
    window.gtag("config", tagId, {
      anonymize_ip: true,
      send_page_view: true,
    });
  };

  const setConsentRecord = (choice) => {
    const record = {
      choice,
      version: consentVersion,
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

    if (consentRecord?.choice && !shouldShowBanner(consentRecord)) {
      document.documentElement.dataset.cookieConsent = consentRecord.choice;
      if (consentRecord.choice === "accepted") {
        loadAnalytics();
      }
    } else if (banner) {
      banner.hidden = false;
    }

    document.querySelectorAll("[data-cookie-consent]").forEach((button) => {
      button.addEventListener("click", () => {
        const choice = button.getAttribute("data-cookie-consent") || "rejected";
        setConsentRecord(choice);
        if (choice === "accepted") {
          loadAnalytics();
        }
        if (banner) {
          banner.hidden = true;
        }
      });
    });
  };

  return { init };
})();
